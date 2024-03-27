@extends('front.layout.layout')
@section('content')
	@foreach($pastInqs as $pastInq)
	<form style="width: 100%; columns: 2 auto;" class="">
		<div class="col-lg-6 col-md-6 u-h-100">
		    <div class="u-s-m-b-30">
		        <h3>Answer</h3>
		        <label for="c-subject"></label>

		        <input class="input-text input-text--border-radius input-text--primary-style col-lg-6" type="text" id="c-subject" name="ans_subject" value="{{ $pastInq['ans_subject'] }}" readonly>
		    </div>
		    <div class="u-s-m-b-60">
		        
		        <label for="c-message"></label><textarea class="text-area text-area--border-radius text-area--primary-style" id="c-message" name="answer" placeholder="Compose a Message (Required)" readonly>{{ $pastInq['answers'] }}</textarea>
		    </div>
		</div>
		<div style="" class="col-lg-6 col-md-6 u-h-100">
		    <div class="u-s-m-b-30">
		        <h3>Your Inquiry</h3>
		        <label for="c-subject"></label>

		        <input class="input-text input-text--border-radius input-text--primary-style col-lg-6" type="text" id="c-subject" name="ans_subject" value="{{ $pastInq['inq_subject'] }}" readonly>
		    </div>
		    <div class="u-s-m-b-60">
		        
		        <label for="c-message"></label><textarea class="text-area text-area--border-radius text-area--primary-style" id="c-message" name="answer" placeholder="Compose a Message (Required)" readonly>{{ $pastInq['inquiry_details'] }}</textarea>
		    </div>
		    Date:{{ date("Y/m/d H:i:s", strtotime($pastInq['created_at'])); }}
		</div>
	</form> 
	@endforeach
@endsection