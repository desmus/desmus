<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicFileView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicFileView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicFileView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_file_id', 'Public File Id:') !!}
  <p>{!! $publicFileView->public_file_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicFileView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicFileView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicFileView->updated_at !!}</p>
</div>