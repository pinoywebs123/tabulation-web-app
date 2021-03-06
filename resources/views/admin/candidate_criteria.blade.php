@extends('admin.template')

@section('contents')

@include('shared.notification')
<div class="col-md-6">
  <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">Add Candidates</button>
</div>
<div class="col-md-6">
  <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal2">Add Criterias</button>
</div>


<div class="text-center">
  <h3 class="text-center">{{$preevent ->name}}</h3>
</div>
<div class="row">
  <div class="col-md-8">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Date of Birth</th>
          <!-- <th>Info</th> -->
          
        </tr>
      </thead>
      <tbody>
       @foreach($candidates as $candi)
        <tr>
          <td><span class="badge">{{$candi->id}}</span></td>
          <td>{{$candi->fullName()}}</td>
          <td>{{$candi->gender}}</td>
          <td>{{$candi->dob}}</td>
          <!-- <td>
             <button class="btn btn-info btn-xs" value="{{$candi->id}}">Edit</button>
          </td> -->
         
        </tr>
       @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-4">
    <ul class="list-group">
      <li class="list-group-item active">List of Criteria</li>
      @foreach($criterias as $cri)
        <li class="list-group-item">
          <button class="btn btn-info btn-xs edit_btn" data-toggle="modal" data-target="#myModal3" value="{{$cri->id}}">Edit</button>
          {{$cri->name}} - 
          <span class="badge">{{$cri->ratio}}% -</span>

        </li>

      @endforeach
      
      
    </ul>
  </div>
</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pre Event Information</h4>
      </div>
      <form action="{{route('admin_create_candidate')}}" method="POST">
        <div class="modal-body">
          <input type="hidden" name="pre_event_id" value="{{$preevent ->id}}">
          <div class="row">
            <div class="col-md-4 form-group">
              <label>First Name</label>
              <input type="text" name="f_name" class="form-control" >
            </div>
            <div class="col-md-4">
              <label>Middle Name</label>
              <input type="text" name="m_name" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Last Name</label>
              <input type="text" name="l_name" class="form-control" >
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Gender</label>
                  <select class="form-control" name="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="LQBTQ">LQBTQ</option>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control">
               </div>
            </div>
          </div>
          <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="form-control"></textarea>
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
        <h4 class="modal-title">Criteria Informations</h4>
      </div>
      <form action="{{route('admin_candidate_criteria_post')}}" method="POST">
        <div class="modal-body">
          <input type="hidden" name="sub_event_id" value="{{$preevent ->id}}">
          <div class="form-group">
            <label>Criteria Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Ratio/Percentage</label>
            <input type="number" name="ratio" class="form-control" maxlength="2">
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

<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Criteria Informations</h4>
      </div>
      <form action="{{route('admin_update_criteria')}}" method="POST">
        <div class="modal-body">
          <input type="hidden" name="criteria_id" id="criteria_id">
          <div class="form-group">
            <label>Criteria Name</label>
            <input type="text" name="name" class="form-control" id="name">
          </div>
          <div class="form-group">
            <label>Ratio/Percentage</label>
            <input type="number" name="ratio" class="form-control" maxlength="2" id="ratio">
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
          var url = '{{route('admin_find_criteria')}}';
            

            $(".edit_btn").click(function(){
              console.log($(this).val());
              var criteria_id = $(this).val();

              $.ajax({
                method: 'POST',
                url: url,
                data: { criteria_id :criteria_id , _token : token},
                success: function( msg ){
                  console.log(msg);
                  $("#name").val(msg.name);
                  $("#ratio").val(msg.ratio);
                  $("#criteria_id").val(msg.id);
                }
            });


            });

           


        } );
    </script>
@endsection