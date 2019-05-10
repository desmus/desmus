<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('actual_name', 'Actual Name:') !!}
  <p>{!! $jobUpdate->actual_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('past_name', 'Past Name:') !!}
  <p>{!! $jobUpdate->past_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $jobUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('job_id', 'Job Id:') !!}
  <p>{!! $jobUpdate->job_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobUpdate->updated_at !!}</p>
</div>