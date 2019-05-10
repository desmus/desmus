<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactSocialUpdates->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactSocialUpdates->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactSocialUpdates->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_social_id', 'Contact Social Id:') !!}
  <p>{!! $contactSocialUpdates->contact_social_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactSocialUpdates->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactSocialUpdates->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactSocialUpdates->updated_at !!}</p>
</div>