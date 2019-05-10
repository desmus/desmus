<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $calendarEventCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $calendarEventCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $calendarEventCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('calendar_event_id', 'Calendar Event Id:') !!}
  <p>{!! $calendarEventCreate->calendar_event_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $calendarEventCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $calendarEventCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $calendarEventCreate->updated_at !!}</p>
</div>