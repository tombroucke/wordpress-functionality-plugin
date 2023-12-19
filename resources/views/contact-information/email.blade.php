@if ($email)
	<a href="{!! Str::emailLink($email) !!}">{!! $email !!}</a>
@endif
