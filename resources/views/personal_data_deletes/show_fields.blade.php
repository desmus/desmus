<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $personalDataDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $personalDataDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $personalDataDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('personal_data_id', 'Personal Data Id:') !!}
  <p>{!! $personalDataDelete->personal_data_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $personalDataDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $personalDataDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $personalDataDelete->updated_at !!}</p>
</div>