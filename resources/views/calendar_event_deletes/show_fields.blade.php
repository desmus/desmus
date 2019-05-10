<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $calendarEventDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $calendarEventDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $calendarEventDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('calendar_event_id', 'Calendar Event Id:') !!}
  <p>{!! $calendarEventDelete->calendar_event_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $calendarEventDelete->deleted_at !!}</p>
</div>