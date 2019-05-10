<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $sharedProfileNoteUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('actual_name', 'Actual Name:') !!}
  <p>{!! $sharedProfileNoteUpdate->actual_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('past_name', 'Past Name:') !!}
  <p>{!! $sharedProfileNoteUpdate->past_name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $sharedProfileNoteUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $sharedProfileNoteUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('shared_profile_note_id', 'Shared Profile Note Id:') !!}
  <p>{!! $sharedProfileNoteUpdate->shared_profile_note_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $sharedProfileNoteUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $sharedProfileNoteUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $sharedProfileNoteUpdate->updated_at !!}</p>
</div>