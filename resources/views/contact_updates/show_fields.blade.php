<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_id', 'Contact Id:') !!}
  <p>{!! $contactUpdate->contact_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactUpdate->updated_at !!}</p>
</div>