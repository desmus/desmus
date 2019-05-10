<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $calendarEventView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $calendarEventView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $calendarEventView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('calendar_event_id', 'Calendar Event Id:') !!}
  <p>{!! $calendarEventView->calendar_event_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $calendarEventView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $calendarEventView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $calendarEventView->updated_at !!}</p>
</div>