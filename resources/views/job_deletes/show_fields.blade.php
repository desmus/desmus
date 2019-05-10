<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('job_id', 'Job Id:') !!}
  <p>{!! $jobDelete->job_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobDelete->updated_at !!}</p>
</div>