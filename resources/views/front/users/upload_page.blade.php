@extends('front.layout.layout')
@section('content')

<form action="{{ url('user/upload_page_confirm') }}" enctype="multipart/form-data" method="post">@csrf

ID card image：<br>
    <input type="file" name="image"><p>
    @if($errors->has('image'))
        @foreach($errors->get('image') as $message)
			{{ $message }}<br>
		@endforeach
    @endif
    <br>
    <input type="submit" value="Upload image">
</form>

@endsection