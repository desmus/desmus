<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicAdvertisementView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicAdvertisementView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicAdvertisementView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_advertisement_id', 'Public Advertisement Id:') !!}
  <p>{!! $publicAdvertisementView->public_advertisement_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicAdvertisementView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicAdvertisementView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicAdvertisementView->updated_at !!}</p>
</div>