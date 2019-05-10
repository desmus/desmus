<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_id', 'Project Id:') !!}
  <p>{!! $projectDelete->project_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectDelete->updated_at !!}</p>
</div>