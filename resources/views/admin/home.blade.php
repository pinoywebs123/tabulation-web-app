@extends('admin.template')

@section('contents')
<h1 class="text-center">Welcome to Tabulation System</h1>

<form action="{{route('admin_get_candidate_score')}}" method="POST">
	<div class="form-group col-md-4">
		<select name="event" id="event" class="form-control" required="">
			<option value="">Select Events</option>
			@foreach($events as $evt)
				<option value="{{$evt->id}}">{{$evt->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group col-md-4">
		<select name="pre_event_id" id="pre_event" class="form-control" required="">
			
		</select>
	</div>
	<div class="form-group col-md-4">
		@csrf
		<button type="submit" class="btn btn-primary btn-block">GO</button>
	</div>
	
</form>


@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		var token = '{{Session::token()}}';
		var url = '{{route('admin_ajax_event')}}';
		$("#event").change(function(){
			var event_id = $("#event").val();
			$.ajax({
              method: 'POST',
              url: url,
              data: { event_id :event_id , _token : token},
              success: function( msg ){
              	console.log(msg);
              	$("#pre_event").children("option").remove();
                msg.forEach(function(data){

                	$("#pre_event").append('<option value="'+data.id+'">'+data.name+'</option>');
                });
                
              }
          });
			
      	});  
	});
	
</script>
@endsection