@unless(!$signupForm || $signupForm === '')
	{!! $signupForm !!}
@else
	<!-- Newsletter signup form not found. Please add the newsletter signup form code in General Settings > Newsletter -->
@endunless
