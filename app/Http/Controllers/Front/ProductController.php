<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsFilter;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\DeliveryAddress;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrdersProduct;
use DB;
use Session;
use Auth;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function listing(Request $request){
        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count();
        if($categoryCount>0){
            // echo "Category exists";

            // Get Category Details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);

            // Get Category and their Sub Category Products
            $categoryProducts = Product::with(['brand', 'images'])->whereIn('category_id', $categoryDetails['catIds'])->where('products.status', 1);
            // dd($categoryProducts);
            // echo "<pre>"; print_r($categoryProducts);die;

            // Update Query for Products Sorting
            if(isset($request['sort'])&&!empty($request['sort'])){
                if($request['sort']=="product_latest"){
                    $categoryProducts->orderBy('id', 'Desc'); 
                }else if($request['sort']=="lowest_price"){
                    $categoryProducts->orderBy('final_price', 'ASC'); 
                }else if($request['sort']=="highest_price"){
                    $categoryProducts->orderBy('final_price', 'DESC');
                }else if($request['sort']=="best_selling"){
                    $categoryProducts->where('is_bestseller', 'Yes');
                }else if($request['sort']=="featured_items"){
                    $categoryProducts->where('is_featured', 'Yes');
                }else if($request['sort']=="discounted_items"){
                    $categoryProducts->where('product_discount', '>', 0);
                }else{
                    $categoryProducts->orderBy('products.id', 'Desc'); 

                }
            }

            // Update Query for Colors Filters
            if(isset($request['color'])&&!empty($request['color'])){
                $colors = explode('~', $request['color']);
                $categoryProducts->whereIn('products.family_color', $colors);
            }   

            // Update Query for Sizes Filters
            if(isset($request['size'])&&!empty($request['size'])){
                $sizes = explode('~', $request['size']);
                $categoryProducts->join('products_attributes', 'products_attributes.product_id','=', 'products.id')->whereIn('products_attributes.size', $sizes)->groupBy('products_attributes.product_id');
            }

            // Update Query for Brands Filters
            if(isset($request['brand'])&&!empty($request['brand'])){
                $brands = explode('~', $request['brand']);
                $categoryProducts->whereIn('products.brand_id', $brands);
            }

            // Update Query for Prices Filters
            if(isset($request['price'])&&!empty($request['price'])){
                $request['price'] = str_replace("~", "-", $request['price']);
                $prices = explode('-', $request['price']);
                $count = count($prices);
                $categoryProducts->whereBetween('products.final_price', [$prices[0], $prices[$count-1]]);
            }

            // Update Query for Dynamic Filters
            $filterTypes = ProductsFilter::filterTypes();
            foreach($filterTypes as $key => $filter){
                if($request->$filter){
                    $explodeFilterVals = explode('~', $request->$filter);
                    $categoryProducts->whereIn($filter, $explodeFilterVals);
                }
            }

            $categoryProducts = $categoryProducts->paginate(9);

            if($request->ajax()){
                return response()->json([
                    'view'=>(String)View::make('front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'))
                ]);
            }else{
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }

        }else{
            abort(404);
        }
    }

    public function detail($id){
        $productCount = Product::where('status', 1)->where('id', $id)->count();
        if($productCount==0){
            abort(404);
        }
        $productDetails = Product::with(['category', 'brand', 'attributes'=>function($query){
            $query->where('stock', '>', 0)->where('status', 1);
        }, 'images'])->find($id)->toArray();
        // dd($productDetails);    
        // Get Category Details
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);

        // Get Group Products (Product Colors)
        $groupProducts = array();
        if(!empty($productDetails['group_code'])){
            $groupProducts = Product::select('id', 'product_color')->where('id', '!=', $id)->where(['group_code'=>$productDetails['group_code'], 'status'=>1])->get()->toArray();
            // dd($groupProducts);
        }

        // Get Related Products
        $relatedProducts = Product::with('brand', 'images')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();
        // dd($relatedProducts);

        // Set Session for Recently Viewed Items
        if(empty(Session::get('session_id'))){
            $session_id = md5(uniqid(rand(), true));
        }else{
            $session_id = Session::get('session_id');
        }
        Session::put('session_id', $session_id);

        // Insert Product in recently_viewed_items table if not already exists
        $countRecentlyViewedItems = DB::table('recently_viewed_items')->where(['product_id'=>$id, 'session_id'=>$session_id])->count();
        if($countRecentlyViewedItems==0){
            DB::table('recently_viewed_items')->insert(['product_id'=>$id, 'session_id'=>$session_id, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
        }

        // Get Recently Viewed Products Ids
        $recentProductIds = DB::table('recently_viewed_items')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');
        // dd($recentProductIds);

        // Get Recently Viewed Products
        $recentlyViewedProducts = Product::with('brand', 'images')->whereIn('id', $recentProductIds)->get()->toArray();
        // dd($recentlyViewedProducts);        

        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails', 'groupProducts', 'relatedProducts', 'recentlyViewedProducts'));
    }

    public function getAttributePrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $getAttributePrice = Product::getAttributePrice($data['product_id'], $data['size']);
            // echo "<pre>"; print_r($getAttributePrice); die;
            return $getAttributePrice;
        }
    }

    public function addToCart(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            // Forget the coupon sessions
            Session::forget('couponAmount');
            Session::forget('couponCode');

            // Check Product Stock
            $productStock = ProductsAttribute::productStock($data['product_id'], $data['size']);
            if($data['qty'] > $productStock){
                $message = "Required Quantity is not Available!!";
                return response()->json(['status'=>false, 'message'=>$message]);
            }

            // Check Product Status
            $productStatus = Product::productStatus($data['product_id']);
            if($productStatus==0){
                $message = "This Product is not Available!!";
                return response()->json(['status'=>false, 'message'=>$message]);
            }

            // Check Product Attribute Status
            // $productAttribute = ProductsAttribute::productAttribute($data['product_id']);
            // dd($productAttribute);
            // if($productAttribute?->status==null){
            //     $message = "This Size Product is not Available!!";
            //     return response()->json(['status'=>false, 'message'=>$message]);
            // }

            // $productAttribute = Product::with('attributes')->get()->first();
            // // dd($productAttribute);
            // if($productAttribute?->attributes->status==0){
            //     $message = "This Size Product is not Available!!";
            //     return response()->json(['status'=>false, 'message'=>$message]);
            // }

            // Generate Session Id if not exists
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }else{
                $session_id = Session::get('session_id');
            }
            // echo $session_id;die;

            // Check Product if already exists in the User Cart
            if(Auth::check()){
                // User is logged in
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'product_size'=>$data['size'], 'user_id'=>$user_id])->count();
            }else{
                // User is not logged in
                $user_id = 0;
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'product_size'=>$data['size'], 'session_id'=>$session_id])->count();
            }

            if($countProducts>0){
                $message = "Product already exists in Cart !! <a style='color:#ffffff; text-decoration:wavy underline;' href='/cart'>View Cart</a>";
                return response()->json(['status'=>false, 'message'=>$message]);
            }

            // Save the Product in carts tale
            $item = new Cart;
            $item->session_id = $session_id;
            if(Auth::check()){
                $item->user_id = Auth::user()->id;
            }
            $item->product_id = $data['product_id'];
            $item->product_size = $data['size'];
            $item->product_qty = $data['qty'];
            $item->save();

            // Get Total Cart Items
            $totalCartItems = totalCartItems();

            $getCartItems = getCartItems();


            $message = "Product added successfully in Cart!! <a style='color:#ffffff; text-decoration:wavy underline;' href='/cart'>View Cart</a>";
            return response()->json([
                'status'=>true,
                'message'=>$message,
                'totalCartItems'=>$totalCartItems,
                'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))

            ]);
        }
    }

    public function cart(){
        $getCartItems = getCartItems();
        // dd($getCartItems);
        return view('front.products.cart')->with(compact('getCartItems'));
    }

    public function updateCartItemQty(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            // Get Cart Details
            $cartDetails = Cart::find($data['cartid']);

            // Get Available Product Stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['product_size']])->first()->toArray();  
            // echo "<pre>"; print_r($availableStock);die;

            // Check if desired Stock from user is available
            if($data['qty']>$availableStock['stock']){
                $getCartItems = getCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Stock is Not Available!!',
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))

                ]);
            }

            // Check if product size is available
            $availableSize = ProductsAttribute::where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['product_size'], 'status'=>1])->count(); 

            if($availableSize==0){
                $getCartItems = getCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Size is Not Available!! Please Remove and Choose Another one!!',
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))

                ]);
            }

            // Update the Cart Item Qty
            Cart::where('id', $data['cartid'])->update(['product_qty'=>$data['qty']]);

            // Get Updated Cart Items
            $getCartItems = getCartItems();
            // dd($getCartItems);

            // Get Total Cart Items
            $totalCartItems = totalCartItems();

            // Return the Updated Cart Item via Ajax
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function deleteCartItem(Request $request){
        if($request->ajax()){
            $data = $request->all();
            Cart::where('id', $data['cartid'])->delete();

            /// Get Updated Cart Items
            $getCartItems = getCartItems();

            // Get Total Cart Items
            $totalCartItems = totalCartItems();

            // Return the Updated Cart Item via Ajax
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))

            ]);
        }
    }

    public function emptyCart(Request $request){
        if($request->ajax()){
            // Empty Cart
            emptyCart();

            // Get Updated Cart Items
            $getCartItems = getCartItems();

            // Get Total Cart Items
            $totalCartItems = totalCartItems();

            // Return the Updated Cart Item via Ajax
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))

            ]);
        }
    }

    public function applyCoupon(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Get Updated Cart Items
            $getCartItems = getCartItems();

            // Get Total Cart Items
            $totalCartItems = totalCartItems();

            // Velify Coupon is valid or not
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if($couponCount==0){
                return response()->json([
                    'status'=>false,
                    'totalCartItems'=>$totalCartItems,
                    'message'=>'The Coupon is Not Valid!!',
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            }else{
                // Check for other coupon conditions
                // echo "coupon valid"; die;

                // Get Coupon Details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                // dd($couponDetails);

                // If Coupon is not active
                if($couponDetails->status==0){
                    $error_message = "The Coupon is not Active";
                }

                // If coupon is expired
                $expired_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if($expired_date<$current_date){
                    $error_message = "The coupon is Expired!!";
                }

                // Check if coupon is for Single or Multiple Times
                if($couponDetails->coupon_type=="Single Time"){
                    // Check in orders if coupon is already availed by the user
                    $couponCount = Order::where(['coupon_code'=>$data['code'], 'user_id'=>Auth::user()->id])->count();
                    if($couponCount>=1){
                        $error_message = "This Coupon Code is already Availed by You!!";
                    }
                }

                // If coupon is from selected categories
                // Get all selected categories from coupon
                $catArr = explode(",", $couponDetails->categories);

                // Get all selected brands from coupon
                $brandArr = explode(",", $couponDetails->brands);

                // Get all selected users from coupon
                $usersArr = explode(",", $couponDetails->users);

                foreach($usersArr as $key => $user){
                    $getUserID = User::select('id')->where('email', $user)->first()->toArray();
                    $usersID[] = $getUserID['id'];
                }

                $total_amount = 0;
                foreach($getCartItems as $key => $item){
                    // echo "<pre>"; print_r($item);die;
                    // echo "<pre>"; print_r($brandArr);die;

                    // Check if any cart item does not belong to coupon brand 
                    if(!in_array($item['product']['brand_id'], $brandArr)){
                        $error_message = "The Coupon Code is not for one of the Selected Brands!!";
                    }

                    // Check if any cart item does not belong to coupon category
                    if(!in_array($item['product']['category_id'], $catArr)){
                        $error_message = "The Coupon Code is not for one of the Selected Products!!";
                    }

                    // Check if any cart item does not belong to coupon user
                    if(count($usersArr)>0){
                        if(!in_array($item['user_id'], $usersID)){
                            $error_message = "The Coupon Code is not for You. Try Again with Valid Coupon Code!!";
                        }
                    }
                    $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);

                    $total_amount = $total_amount + ($getAttributePrice['final_price'] * $item['product_qty']);
                }

                // echo $total_amount; die;

                // If Error message is there
                if(isset($error_message)){
                    return response()->json([
                    'status'=>false,
                    'totalCartItems'=>$totalCartItems,
                    'message'=>$error_message,
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                    ]);    
                }else{
                    // Apply Coupon if coupon code is correct

                    // Check if Coupon Amount type is Fixed or Percentage
                    if($couponDetails->amount_type=="Fixed"){
                        $couponAmount = $couponDetails->amount;
                    }else{
                        $couponAmount = $total_amount * ($couponDetails->amount/100);
                    }
                    $grand_total = $total_amount - $couponAmount;

                    // Add Coupon Code & Amount in Session Variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon Code Successfully Applied. You are Available Discount!";

                    return response()->json([
                    'status'=>true,
                    'totalCartItems'=>$totalCartItems,
                    'couponAmount'=>$couponAmount,
                    'grandTotal'=>$grand_total,
                    'message'=>$message,
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'minicartview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                    ]);
                }

            }
        }
    }

    public function checkout(Request $request){

        // Get User Cart Items
        $getCartItems = getCartItems();

        if(count($getCartItems)==0){
            $message = "Shopping Cart is empty!! Please add products to Checkout!";
            return redirect('cart')->with('error_message', $message);
        }

        // Get User Delivery Addresses
        $deliveryAddresses = DeliveryAddress::deliveryAddresses(); 
        // Get All Countries
        $countries = Country::where('status',1)->get()->toArray();

        if($request->isMethod('post')){
            $data = $request->all();
            // print_r($data);die;

            // Check for Delivery Address
            $deliveryAddressCount = DeliveryAddress::where('user_id', Auth::user()->id)->count();
            if($deliveryAddressCount==0){
                return redirect()->back()->with('error_message', 'Please add your Delivery Address');
            }

            // Check for Payment Method
            if(empty($data['payment_gateway'])){
                return redirect()->back()->with('error_message', 'Please select Payment Method');
            }

            // 
            if(!isset($data['agree'])){
                return redirect()->back()->with('error_message', 'Please agree to T&C!!');
            }

            // Check for Default Address
            $deliveryAddressDefaultCount = DeliveryAddress::where('user_id', Auth::user()->id)->with('is_default', 1)->count();
            if($deliveryAddressDefaultCount==0){
                return redirect()->back()->with('error_message', 'Please Select your Delivery Address');
            }else{
                $deliveryAddress = DeliveryAddress::where('user_id', Auth::user()->id)->where('is_default', 1)->first()->toArray();
                // dd($deliveryAddress);
            }
            // Set Payment Method as COD and Order Status as New if COD is selected from user otherwise Set Payment Method as Prepaid and Order Status as Pending

            if($data['payment_gateway']=="COD"){
                $payment_method = "COD";
                $order_status = "New";
            }else{
                $payment_method = "Prepaid";
                $order_status = "Pending";    
            }
            // echo "Proceed to Place Other"; die;

            DB::beginTransaction();

            // Fetch Order Total Price
            $total_price = 0;
            foreach($getCartItems as $item){
                $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
                $total_price = $total_price + ($getAttributePrice['final_price']*$item['product_qty']);
            }

            // Get Shipping Charges
            $shipping_charges = 0;

            // Calculate Grand Total
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');

            // Insert Grand Total in Session Varriable
            Session::put('grand_total', $grand_total);

            // Insert Order Details
            $order = New Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->state = $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();

            foreach($getCartItems as $key => $item){
                $getProductDetails = Product::getProductDetails($item['product_id']);
                $getAttributeDetails = Product::getAttributeDetails($item['product_id'], $item['product_size']);
                $getAttributePrice = Product::getAttributePrice($item['product_id'], $item['product_size']);
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id; 
                $cartItem->user_id = Auth::user()->id; 
                $cartItem->product_id = $item['product_id']; 
                $cartItem->product_code = $getProductDetails['product_code']; 
                $cartItem->product_name = $getProductDetails['product_name']; 
                $cartItem->product_color = $getProductDetails['product_color']; 
                $cartItem->product_size = $item['product_size']; 
                $cartItem->product_sku = $getAttributeDetails['sku']; 
                $cartItem->product_price = $getAttributePrice['final_price']; 
                $cartItem->product_qty = $item['product_qty'];
                $cartItem->save(); 
            }
            // Insert Order Id in Session Variable
            Session::put('order_id', $order_id);
            DB::commit();

            if($data['payment_gateway']=="COD"){

                // Send Order Email

                $orderDetails = Order::with('orders_products', 'user')->where('id', $order_id)->first()->toArray();
                // echo "Order Done"; die;
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails
                ];
                Mail::send('emails.order', $messageData, function($message)use($email){
                    $message->to($email)->subject('Order Place - Sample3');
                });
                return redirect('/thanks');
                
            }if($data['payment_gateway']=="Paypal"){
                // Paypal - Redirect user to Paypal page after saving order
                return redirect('paypal'); 
            }else{
                echo "Prepaid methods coming soon";die;
            }
            
        }

        return view('front.products.checkout')->with(compact('getCartItems', 'deliveryAddresses', 'countries'));
    }

    public function thanks(){
        if(Session::has('order_id')){
            // Empty the User Cart
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.orders.thanks');
        }else{
            return redirect('/cart');
        }
    }
}
