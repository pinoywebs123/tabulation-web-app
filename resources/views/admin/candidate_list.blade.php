@extends('admin.template')

@section('contents')
@include('shared.notification')

<h2 class="text-center">Candidate List</h2>

<table class="table" id="datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Gender</th>
			<th>Date of Bith</th>
			<th>Address</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($candidates as $candi)
			<tr>
				<td>{{$candi->fullName()}}</td>
				<td>{{$candi->gender}}</td>
				<td>{{$candi->dob}}</td>
				<td>{{$candi->address}}</td>
				<td>
					<button class="btn btn-info btn-xs edit_btn" data-toggle="modal" data-target="#myModal" value="{{$candi->id}}">Edit</button>
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
        <h4 class="modal-title">Candidate Information</h4>
      </div>
      <form action="{{route('admin_update_candidate')}}" method="POST">
        <div class="modal-body">
         <input type="hidden" name="candidate_id" id="candidate_id">
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Gender</label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="LQBTQ">LQBTQ</option>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" id="dob">
               </div>
            </div>
          </div>
          <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="form-control" id="address"></textarea>
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
			var url = '{{route('admin_find_candidate')}}';
            $('#datatable').DataTable();

            $(".edit_btn").click(function(){
            	console.log($(this).val());
            	var candidate_id = $(this).val();

            	$.ajax({
	              method: 'POST',
	              url: url,
	              data: { candidate_id :candidate_id , _token : token},
	              success: function( msg ){
	              	console.log(msg);
	              	$("#f_name").val(msg.f_name);
	              	$("#m_name").val(msg.m_name);
	              	$("#l_name").val(msg.l_name);
	              	$("#gender").val(msg.gender);
	              	$("#dob").val(msg.dob);
	              	$("#address").val(msg.address);
	                $("#candidate_id").val(msg.id);
	              }
	          });


            });

           


        } );
    </script>
@endsection