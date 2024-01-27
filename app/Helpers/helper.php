<?php
	use App\Models\Cart;

	function totalCartItems(){
		if(Auth::check()){
			$user_id = Auth::user()->id;
			$totalCartItems = Cart::where('user_id', $user_id)->sum('product_qty');
		}else{
			$session_id = Session::get('session_id');
			$totalCartItems = Cart::where('session_id', $session_id)->sum('product_qty');
		}
		return $totalCartItems;
	}

	function getCartItems(){
        if(Auth::check()){
            // If the User logged in ,check from Auth(user_id)
            $user_id = Auth::user()->id;
            $getCartItems = Cart::with('product')->wehre('user_id', $user_id)->get()->toArray();
        }else{
            // If the User not logged in, check from Session (session_id)
            $session_id = Session::get('session_id');
            $getCartItems = Cart::with('product')->where('session_id', $session_id)->get()->toArray();
        }
        return $getCartItems;
    }

    function emptyCart(){
        if(Auth::check()){
            // If the User logged in ,check from Auth(user_id)
            $user_id = Auth::user()->id;
            Cart::with('product')->wehre('user_id', $user_id)->delete();
        }else{
            // If the User not logged in, check from Session (session_id)
            $session_id = Session::get('session_id');
            Cart::with('product')->where('session_id', $session_id)->delete();
        }
    }
