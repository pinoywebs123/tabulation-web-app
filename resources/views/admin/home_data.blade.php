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

<table class="table table-striped">
	<thead>
		<tr>
			<th>Candidate</th>
			<th>Score</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($groups as $value)
		<tr>
			<td>{{$value->candidate}}</td>
			<?php $final = 0; ?>
			@foreach($value->data as $value2)
				
					<?php $new_ratio = '.'.$value2->ratio ?>
					<?php $final = $final + ($value2->score * $new_ratio); ?>
					
					
			@endforeach
			<td>
				<?php echo $final; ?>
				<div class="progress">
				    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $final; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $final; ?>%">
				     
				    </div>
				  </div>


			</td>
		</tr>
		@endforeach
	</tbody>
</table>
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