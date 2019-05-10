<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $messageView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $messageView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $messageView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('message_id', 'Message Id:') !!}
  <p>{!! $messageView->message_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $messageView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $messageView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $messageView->updated_at !!}</p>
</div>