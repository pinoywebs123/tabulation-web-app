@extends('admin.template')

@section('contents')
<h1 class="text-center">Welcome to Tabulation System</h1>

<form>
	<div class="form-group col-md-4">
		<select name="event" id="event" class="form-control">
			<option value="">Select Event</option>
		</select>
	</div>
	<div class="form-group col-md-4">
		<select name="event" id="event" class="form-control">
			<option value="">Select Pre-Event</option>
		</select>
	</div>
	<div class="form-group col-md-4">
		<button type="submit" class="btn btn-primary btn-block">GO</button>
	</div>
	
</form>
@endsection