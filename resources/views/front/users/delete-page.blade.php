@extends('front.layout.layout')
@section('content')

<form id="withdrawal-form" action="{{ route('user.withdrawal') }}" method="post" style="display:none;">{{ csrf_field() }}</form>
<h2>Withdrawal</h2>
<a href="{{ route('user.withdrawal') }}" onclick="alert('(Tentative) If there is something in the cart, or an explanation about the tournament after payment is required. thank you very much. Until next registration, goodbye');event.preventDefault();document.getElementById('withdrawal-form').submit();"><h2>Withdrawal</h2></a>

@endsection