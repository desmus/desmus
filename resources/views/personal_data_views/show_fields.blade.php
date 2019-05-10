<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $personalDataView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $personalDataView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $personalDataView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('personal_data_id', 'Personal Data Id:') !!}
  <p>{!! $personalDataView->personal_data_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $personalDataView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $personalDataView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $personalDataView->updated_at !!}</p>
</div>