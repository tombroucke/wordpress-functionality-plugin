@if($phone || $email)
<p>
	@if ($phone)
		<a href="{{ Str::phoneLink($phone) }}">{{ $phone }}</a><br>
	@endif
	@if ($email)
		<a href="{{ Str::emailLink($email) }}">{{ $email }}</a>
	@endif
</p>
@endif
