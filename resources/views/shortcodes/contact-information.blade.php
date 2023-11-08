@if(!$property)
	{!! DokDrieContactInformation::formattedAddress() !!}
	{!! DokDrieContactInformation::formattedPhoneEmail() !!}
@else
	@if($property == 'address')
		{!! DokDrieContactInformation::formattedAddress() !!}
	@endif
	@if($property == 'phone' && DokDrieContactInformation::phone())
		{!! DokDrieContactInformation::formattedPhone() !!}
	@endif
	@if($property == 'email' && DokDrieContactInformation::email())
		{!! DokDrieContactInformation::formattedEmail() !!}
	@endif
	@if($property == 'vat_number' && DokDrieContactInformation::vatNumber())
		{!! DokDrieContactInformation::vatNumber() !!}
	@endif
	@if($property == 'bank_account_number' && DokDrieContactInformation::bankAccountNumber())
		{!! DokDrieContactInformation::bankAccountNumber() !!}
	@endif
@endif
