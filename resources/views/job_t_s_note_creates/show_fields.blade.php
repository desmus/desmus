<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $jobTSNoteCreate->id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('datetime', 'Datetime:') !!}
    <p>{!! $jobTSNoteCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $jobTSNoteCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('job_t_s_note_id', 'Job T S Note Id:') !!}
  <p>{!! $jobTSNoteCreate->job_t_s_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $jobTSNoteCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $jobTSNoteCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $jobTSNoteCreate->updated_at !!}</p>
</div>