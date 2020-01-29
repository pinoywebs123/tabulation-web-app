@extends('admin.template')

@section('contents')
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Create Event</button>

@include('shared.notification')

<table class="table table-striped">
  <thead>
    <tr>
      <th>Event Name</th>
      <th>Date</th>
      <th>Status</th>
      <!-- <th>Actions</th> -->
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
        <td>
          <!-- <button class="btn btn-info btn-xs" value="{{$event->id}}">Edit</button> -->
          
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
      <form action="{{route('admin_event_post')}}" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Event Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Event Date</label>
            <input type="date" name="date" class="form-control">
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