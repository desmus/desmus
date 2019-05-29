<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileNoteC->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $sharedProfileNoteC->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $sharedProfileNoteC->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileNoteC->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_note_id', 'Shared Profile Note Id:') !!}
  <p>{!! $sharedProfileNoteC->shared_profile_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileNoteC->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileNoteC->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileNoteC->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileNoteC->updated_at !!}</p>
</div>