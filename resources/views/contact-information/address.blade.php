@if($company || $street || $city)
<p>
	@if ($company)
		{!! $company !!}<br>
	@endif
	@if ($street && $streetNumber)
		{!! $street !!} {!! $streetNumber !!}<br>
	@elseif ($street)
		{!! $street !!}<br>
	@endif
	@if ($postcode && $city)
		{!! $postcode !!} {!! $city !!}<br>
	@elseif ($city)
		{!! $city !!}<br>
	@endif
</p>
@endif
