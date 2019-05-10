<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactAddressUpdates->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactAddressUpdates->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactAddressUpdates->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_address_id', 'Contact Address Id:') !!}
  <p>{!! $contactAddressUpdates->contact_address_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactAddressUpdates->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactAddressUpdates->created_at !!}</p>
</div>

<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $contactAddressUpdates->updated_at !!}</p>
</div>