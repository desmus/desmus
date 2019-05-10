<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactEmailCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactEmailCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactEmailCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_email_id', 'Contact Email Id:') !!}
  <p>{!! $contactEmailCreate->contact_email_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactEmailCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactEmailCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactEmailCreate->updated_at !!}</p>
</div>