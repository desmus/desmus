<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userCalendarEventUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userCalendarEventUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userCalendarEventUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_c_e_id', 'User C E Id:') !!}
  <p>{!! $userCalendarEventUpdate->user_c_e_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userCalendarEventUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userCalendarEventUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userCalendarEventUpdate->updated_at !!}</p>
</div>