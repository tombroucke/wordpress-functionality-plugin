@unless($schedule->isEmpty())
<table class="table">
	<tbody>
		@foreach($schedule as $day)
		<tr>
			<th>{{ ucfirst($day['day']) }}</th>
			<td>
				@foreach($day['hours'] as $hour)
					@if(is_array($hour))
						{!! implode(' - ', array_filter(Arr::flatten($hour))) !!}
					@endif
					@unless($loop->last)
						<br>
					@endunless
				@endforeach
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endunless
