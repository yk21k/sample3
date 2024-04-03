<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use Session;

class OrdersController extends Controller
{
    public function orders(){
        Session::put('page', 'orders');
        $orders = Order::with('orders_products', 'user')->orderBy('id', 'Desc')->get()->toArray();
        // dd($orders);
        return view('admin.orders.orders')->with(compact('orders'));
    }

    public function orderDetails($id){
        $orderDetails = Order::with('orders_products', 'user')->where('id', $id)->first()->toArray();
        // dd($orderDetails);
        $orderStatuses = OrderStatus::where('status',1)->get()->toArray();
        // dd($orderStatuses);

        return view('admin.orders.order_detail')->with(compact('orderDetails', 'orderStatuses'));

    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            Order::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);
            $message = "Order Status has been updated Successfully!!";
            return redirect()->back()->with('success_message', $message);
        }
    }
}
