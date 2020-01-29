@extends('admin.template')

@section('contents')
@include('shared.notification')

<h2 class="text-center">Judges List</h2>
<button class="btn btn-primary btn-xs edit_btn" data-toggle="modal" data-target="#myModal2" >Create</button>
<table class="table" id="datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($judges as $judg)
			<tr>
				<td>{{$judg->fullName()}}</td>
				<td>{{$judg->email}}</td>
				
				<td>
					<button class="btn btn-info btn-xs edit_btn" data-toggle="modal" data-target="#myModal" value="{{$judg->id}}">Edit</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Judge Information</h4>
      </div>
      <form action="{{route('admin_update_judge')}}" method="POST">
        <div class="modal-body">
         <input type="hidden" name="judge_id" id="judge_id">
          <div class="row">
            <div class="col-md-4 form-group">
              <label>First Name</label>
              <input type="text" name="f_name" class="form-control" id="f_name">
            </div>
            <div class="col-md-4">
              <label>Middle Name</label>
              <input type="text" name="m_name" class="form-control" id="m_name">
            </div>
            <div class="col-md-4">
              <label>Last Name</label>
              <input type="text" name="l_name" class="form-control" id="l_name">
            </div>
          </div>
          <div class="form-group">
          	<label>Email</label>
          	<input type="email" name="email" id="email" class="form-control">
          </div>
          
          
        </div>
        <div class="modal-footer">
          @csrf
          <button type="submit" class="btn btn-primary" >Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Judge Information</h4>
      </div>
      <form action="{{route('admin_create_judge')}}" method="POST">
        <div class="modal-body">
         
          <div class="row">
            <div class="col-md-4 form-group">
              <label>First Name</label>
              <input type="text" name="f_name" class="form-control" id="f_name">
            </div>
            <div class="col-md-4">
              <label>Middle Name</label>
              <input type="text" name="m_name" class="form-control" id="m_name">
            </div>
            <div class="col-md-4">
              <label>Last Name</label>
              <input type="text" name="l_name" class="form-control" id="l_name">
            </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          
          
        </div>
        <div class="modal-footer">
          @csrf
          <button type="submit" class="btn btn-primary" >Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
        $(document).ready( function () {
        	var token = '{{Session::token()}}';
			var url = '{{route('admin_find_judge')}}';
            $('#datatable').DataTable();

            $(".edit_btn").click(function(){
            	console.log($(this).val());
            	var judge_id = $(this).val();

            	$.ajax({
	              method: 'POST',
	              url: url,
	              data: { judge_id :judge_id , _token : token},
	              success: function( msg ){
	              	console.log(msg);
	              	$("#f_name").val(msg.f_name);
	              	$("#m_name").val(msg.m_name);
	              	$("#l_name").val(msg.l_name);
	              	$("#email").val(msg.email);
	              	$("#judge_id").val(msg.id);
	              }
	          });


            });

           


        } );
    </script>
@endsection