<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactAddressCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactAddressCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactAddressCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_address_id', 'Contact Address Id:') !!}
  <p>{!! $contactAddressCreate->contact_address_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactAddressCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactAddressCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactAddressCreate->updated_at !!}</p>
</div>