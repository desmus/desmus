<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('actual_name', 'Actual Name:') !!}
  <p>{!! $projectUpdate->actual_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('past_name', 'Past Name:') !!}
  <p>{!! $projectUpdate->past_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $projectUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_id', 'Project Id:') !!}
  <p>{!! $projectUpdate->project_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectUpdate->updated_at !!}</p>
</div>