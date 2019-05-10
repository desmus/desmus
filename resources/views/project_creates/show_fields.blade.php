<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_id', 'Project Id:') !!}
  <p>{!! $projectCreate->project_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectCreate->updated_at !!}</p>
</div>