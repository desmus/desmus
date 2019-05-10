<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactSocialCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactSocialCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactSocialCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_social_id', 'Contact Social Id:') !!}
  <p>{!! $contactSocialCreate->contact_social_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactSocialCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactSocialCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactSocialCreate->updated_at !!}</p>
</div>