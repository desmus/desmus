<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactWebCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactWebCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactWebCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_web_id', 'Contact Web Id:') !!}
  <p>{!! $contactWebCreate->contact_web_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactWebCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactWebCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactWebCreate->updated_at !!}</p>
</div>