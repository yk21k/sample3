<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrdersLog;
use Session;
use Auth;


class OrdersController extends Controller
{
    public function orders(){
        Session::put('page', 'orders');
        $orders = Order::with('orders_products', 'user')->orderBy('id', 'Desc')->get()->toArray();
        // dd($orders);
        return view('admin.orders.orders')->with(compact('orders'));
    }

    public function orderDetails($id){
        $orderDetails = Order::with('orders_products', 'user', 'log')->where('id', $id)->first()->toArray();
        $orderStatuses = OrderStatus::where('status',1)->get()->toArray();
        // dd($orderDetails);
        // dd($orderStatuses);

        return view('admin.orders.order_detail')->with(compact('orderDetails', 'orderStatuses'));

    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            Order::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);

            // Update Courier Name & Tracking Number
            if(!empty($data['courier_name'])&&!empty($data['tracking_number'])){
                Order::where('id', $data['order_id'])->update(['courier_name'=>$data['courier_name'], 'tracking_number'=>$data['tracking_number']]);

                // Send Order Shipped Email to Customer with Tracking Details

                $orderDetails = Order::with('orders_products', 'user')->where('id', $data['order_id'])->first()->toArray(); //*
                // echo "Order Done"; die;

                // Send Order Shipped Email
                $email = $orderDetails['user']['email']; //*
                $messageData = [
                    'email' => $email,
                    'name' => $orderDetails['user']['email'], //*
                    'order_id' => $data['order_id'], //*
                    'order_status' => $data['order_status'],
                    'courier_name' => $data['courier_name'],
                    'tracking_number' => $data['tracking_number'],
                    'orderDetails' => $orderDetails
                ];
                Mail::send('emails.shipped_order', $messageData, function($message)use($email){
                    $message->to($email)->subject('Order Shipped (Tracking Details) - Sample3');
                });
            }

            // Insert Order Status in Order Logs
            $log = new OrdersLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();



            $message = "Order Status has been updated Successfully!!";
            return redirect()->back()->with('success_message', $message);
        }
    }
}
