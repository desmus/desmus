<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactEmailView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactEmailView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactEmailView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_email_id', 'Contact Email Id:') !!}
  <p>{!! $contactEmailView->contact_email_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactEmailView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactEmailView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactEmailView->updated_at !!}</p>
</div>