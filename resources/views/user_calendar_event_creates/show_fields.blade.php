<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userCalendarEventCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userCalendarEventCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userCalendarEventCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_c_e_id', 'User C E Id:') !!}
  <p>{!! $userCalendarEventCreate->user_c_e_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userCalendarEventCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userCalendarEventCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userCalendarEventCreate->updated_at !!}</p>
</div>