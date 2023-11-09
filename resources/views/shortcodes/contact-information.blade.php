@if(!$property)
	{!! FunctionalityPluginContactInformation::formattedAddress() !!}
	{!! FunctionalityPluginContactInformation::formattedPhoneEmail() !!}
@else
	@if($property == 'address')
		{!! FunctionalityPluginContactInformation::formattedAddress() !!}
	@endif
	@if($property == 'phone' && FunctionalityPluginContactInformation::phone())
		{!! FunctionalityPluginContactInformation::formattedPhone() !!}
	@endif
	@if($property == 'email' && FunctionalityPluginContactInformation::email())
		{!! FunctionalityPluginContactInformation::formattedEmail() !!}
	@endif
	@if($property == 'vat_number' && FunctionalityPluginContactInformation::vatNumber())
		{!! FunctionalityPluginContactInformation::vatNumber() !!}
	@endif
	@if($property == 'bank_account_number' && FunctionalityPluginContactInformation::bankAccountNumber())
		{!! FunctionalityPluginContactInformation::bankAccountNumber() !!}
	@endif
@endif
