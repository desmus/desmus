<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $messageCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $messageCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $messageCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('message_id', 'Message Id:') !!}
  <p>{!! $messageCreate->message_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $messageCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $messageCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $messageCreate->updated_at !!}</p>
</div>