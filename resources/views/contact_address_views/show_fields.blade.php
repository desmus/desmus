<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactAddressView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactAddressView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactAddressView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_address_id', 'Contact Address Id:') !!}
  <p>{!! $contactAddressView->contact_address_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactAddressView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactAddressView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactAddressView->updated_at !!}</p>
</div>