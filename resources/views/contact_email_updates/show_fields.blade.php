<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactEmailUpdates->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactEmailUpdates->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactEmailUpdates->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_email_id', 'Contact Email Id:') !!}
  <p>{!! $contactEmailUpdates->contact_email_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactEmailUpdates->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactEmailUpdates->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactEmailUpdates->updated_at !!}</p>
</div>