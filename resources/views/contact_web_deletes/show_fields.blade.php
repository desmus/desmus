<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactWebDeletes->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactWebDeletes->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactWebDeletes->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_web_id', 'Contact Web Id:') !!}
  <p>{!! $contactWebDeletes->contact_web_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactWebDeletes->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactWebDeletes->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactWebDeletes->updated_at !!}</p>
</div>