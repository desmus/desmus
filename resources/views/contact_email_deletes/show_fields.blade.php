<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactEmailDeletes->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactEmailDeletes->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactEmailDeletes->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_email_id', 'Contact Email Id:') !!}
  <p>{!! $contactEmailDeletes->contact_email_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactEmailDeletes->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactEmailDeletes->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactEmailDeletes->updated_at !!}</p>
</div>