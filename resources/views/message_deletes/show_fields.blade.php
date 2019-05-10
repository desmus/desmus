<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $messageDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $messageDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $messageDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('message_id', 'Message Id:') !!}
  <p>{!! $messageDelete->message_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $messageDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $messageDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $messageDelete->updated_at !!}</p>
</div>