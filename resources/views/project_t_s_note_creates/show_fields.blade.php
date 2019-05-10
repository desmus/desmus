<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $projectTSNoteCreate->id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('datetime', 'Datetime:') !!}
    <p>{!! $projectTSNoteCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $projectTSNoteCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('project_t_s_note_id', 'Project T S Note Id:') !!}
  <p>{!! $projectTSNoteCreate->project_t_s_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $projectTSNoteCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $projectTSNoteCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $projectTSNoteCreate->updated_at !!}</p>
</div>