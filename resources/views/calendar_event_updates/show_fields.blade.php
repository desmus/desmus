<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $calendarEventUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('actual_name', 'Actual Name:') !!}
  <p>{!! $calendarEventUpdate->actual_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('past_name', 'Past Name:') !!}
  <p>{!! $calendarEventUpdate->past_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $calendarEventUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $calendarEventUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('calendar_event_id', 'Calendar Event Id:') !!}
  <p>{!! $calendarEventUpdate->calendar_event_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $calendarEventUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $calendarEventUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $calendarEventUpdate->updated_at !!}</p>
</div>