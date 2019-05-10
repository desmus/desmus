<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $personalDataCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $personalDataCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $personalDataCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('personal_data_id', 'Personal Data Id:') !!}
  <p>{!! $personalDataCreate->personal_data_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $personalDataCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $personalDataCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $personalDataCreate->updated_at !!}</p>
</div>