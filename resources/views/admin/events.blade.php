@extends('admin.template')

@section('contents')
<button id="btncreate" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Create Event</button>

@include('shared.notification')

<table class="table table-striped">
  <thead>
    <tr>
      <th>Event Name</th>
      <th>Date</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($events as $event)
      <tr>
        <td>
          <a href="{{route('admin_pre_events',['event_id'=> $event->id])}}">{{$event->name}}</a>
        </td>
        <td>{{$event->date}}</td>
        <td>{{$event->status_id}}</td>
        <td class="hidden">{{$event->id}}</td>
        <td class="hidden">{{$event->name}}</td>
        <td class="hidden">{{$event->description}}</td>
        <td>
          <button class="btnedit btn btn-info btn-xs" value="{{$event->id}}" data-toggle="modal" data-target="#myModal">Edit</button>
          <button class="btn btn-danger btn-xs" value="{{$event->id}}">Closed</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<center>{{$events->links()}}</center>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Event Information</h4>
      </div>
      <form id="frmevents" action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Event Name</label>
            <input id="event_name" type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Event Description</label>
            <textarea id="event_desc" name="description" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Event Date</label>
            <input id="event_date" type="date" name="date" class="form-control">
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
        let create_or_edit, event_id;

        $('#btncreate').click(function() {
            create_or_edit = "create";
        });

        $('.btnedit').click(function() {
            create_or_edit = "edit";
            event_id = $(this).parent().parent().children('td:nth-of-type(4)').text();

            $('#event_name').val($(this).parent().parent().children('td:nth-of-type(5)').text());
            $('#event_desc').val($(this).parent().parent().children('td:nth-of-type(6)').text());
            $('#event_date').val($(this).parent().parent().children('td:nth-of-type(2)').text());
        });

        $('#btnsubmit').click(function() {
            if (create_or_edit == "create")
                $('#frmevents').attr('action', "{{route('admin_event_post')}}");
            else if (create_or_edit == "edit") {
                let url = '{{route("admin_event_update", ":id")}}';
                url = url.replace(':id', event_id);

                $('#frmevents').attr('action', url);
            }
        });
    </script>
@endsection