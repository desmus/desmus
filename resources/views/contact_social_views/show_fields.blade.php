<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactSocialView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactSocialView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactSocialView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_social_id', 'Contact Social Id:') !!}
  <p>{!! $contactSocialView->contact_social_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactSocialView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactSocialView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactSocialView->updated_at !!}</p>
</div>