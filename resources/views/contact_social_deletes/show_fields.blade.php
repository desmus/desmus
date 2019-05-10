<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactSocialDeletes->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactSocialDeletes->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactSocialDeletes->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_social_id', 'Contact Social Id:') !!}
  <p>{!! $contactSocialDeletes->contact_social_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactSocialDeletes->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactSocialDeletes->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactSocialDeletes->updated_at !!}</p>
</div>