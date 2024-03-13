<!-- <?php
    use App\Models\Order;
    $user_name = Order::with('user')->first()->toArray();
?> -->
<!--====== Dashboard Features ======-->
<div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
    <div class="dash__pad-1">
        <span class="dash__text u-s-m-b-16">Hello, <strong>{{ $user_name['name'] }} {{ $orderDetails['name'] }} {{ $orderDetails['user']['name'] }}</strong> </span>
        <ul class="dash__f-list">
            <li><a href="{{ url('user/account') }}">My Billing/Contact Address</a></li>
            <li><a href="{{ url('user/orders') }}">My Orders</a></li>
            <li><a href="wishlist.html">My Wish List</a></li>
            <li><a href="">Upload your ID (driver's license only, ??50cc motorcycle only, no driver's license??)</a></li>
            <li><a href="{{ url('user/update-password') }}">Update Password</a></li>
        </ul>
    </div>
</div>
<!--====== End - Dashboard Features ======-->
