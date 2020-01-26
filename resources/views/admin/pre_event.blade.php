@extends('admin.template')

@section('contents')
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Create Pre Event</button>

@include('shared.notification')
<div class="text-center">
  <h3>{{$event->name}}</h3>
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
        <td>{{$pre->pivot->status_id}}</td>
        <td>
           <button class="btn btn-info btn-xs" value="{{$event->id}}">Edit</button>
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
      <form action="{{route('admin_pre_event_post')}}" method="POST">
        <div class="modal-body">
          <input type="hidden" name="event_id" value="{{$event->id}}">
          <div class="form-group">
            <label>Pre Event Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Pre Event Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Pre Event Date</label>
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