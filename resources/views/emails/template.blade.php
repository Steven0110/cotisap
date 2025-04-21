
<div style="box-sizing: border-box;">
	<div style="background: #337ab7; color: white; text-align: center; padding: 10px; font-size: 25px;">
		{{$header}}
	</div>
	<div style="text-align: left; padding: 30px; padding-left: 50px; font-size: 16px; border-left: 3px solid #bce8f1;border-right: 3px solid #bce8f1;">
		{!! $raw_body !!}
	</div>
	@if($footer)
	<div style="background: #bce8f1; color: darkblue; padding: 30px; font-size: 25px; text-align: center;">
		{{$footer}}
	</div>
	@endif
</div>
