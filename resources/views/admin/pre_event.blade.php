@extends('admin.template')

@section('contents')
<button id="btncreate" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Create Pre Event</button>

@include('shared.notification')
<div class="text-center">
  <h1>{{$event->name}}</h1>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Pre Event Name</th>
      <th>Date</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($events as $pre)
      <tr>
        <td>
          <a href="{{route('admin_candidate_criteria',['pre_event_id'=> $pre->id])}}">{{$pre->name}}</a>
        </td>
        <td>{{$pre->date}}</td>
        <td>{{$pre->status_id}}</td>
        <td class="hidden">{{$pre->event_id}}</td>
        <td class="hidden">{{$pre->name}}</td>
        <td class="hidden">{{$pre->description}}</td>
        <td>
           <button class="btnedit btn btn-info btn-xs" value="{{$event->id}}" data-toggle="modal" data-target="#myModal">Edit</button>
          <button class="btn btn-danger btn-xs" value="{{$event->id}}">Closed</button>
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
        <h4 class="modal-title">Pre Event Information</h4>
      </div>
      <form id="frmpreevents" action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Pre Event Name</label>
            <input id="pre_name" type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Pre Event Description</label>
            <textarea id="pre_desc" name="description" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Pre Event Date</label>
            <input id="pre_date" type="date" name="date" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          @csrf
          <button id="btnsubmit" type="submit" class="btn btn-primary" >Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@section('scripts')
    <script>
        let create_or_edit, pre_id;

        $('#btncreate').click(function() {
            create_or_edit = "create";
        });

        $('.btnedit').click(function() {
            create_or_edit = "edit";
            pre_id = $(this).parent().parent().children('td:nth-of-type(4)').text();

            $('#pre_name').val($(this).parent().parent().children('td:nth-of-type(5)').text());
            $('#pre_desc').val($(this).parent().parent().children('td:nth-of-type(6)').text());
            $('#pre_date').val($(this).parent().parent().children('td:nth-of-type(2)').text());
        });

        $('#btnsubmit').click(function() {
            if (create_or_edit == "create")
                $('#frmpreevents').attr('action', "{{route('admin_pre_event_post', request()->segment(3))}}");
            else if (create_or_edit == "edit") {
                let url = '<?php echo route("admin_pre_event_update", [Request::segment(3), ":pre_id"]) ?>';
                url = url.replace(':pre_id', pre_id);

                $('#frmpreevents').attr('action', url);
            }
        });
    </script>
@endsection