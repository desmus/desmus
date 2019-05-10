<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactWebUpdates->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactWebUpdates->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactWebUpdates->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_web_id', 'Contact Web Id:') !!}
  <p>{!! $contactWebUpdates->contact_web_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactWebUpdates->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactWebUpdates->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactWebUpdates->updated_at !!}</p>
</div>