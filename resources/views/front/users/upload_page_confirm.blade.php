@extends('front.layout.layout')
@section('content')

<form action="{{ url('user/upload_page_confirm') }}" method="post">@csrf
<br>
ID card image：<br>
    <img src="{{ url('/storage/'.$image_path) }}" alt="" width="40%">
    <input type="hidden" name="image_path" value="{{ $image_path }}">
    <input type="hidden" name="extension" value="{{ $extension }}"><br>
    <input type="submit" value="complete">
</form>

@endsection