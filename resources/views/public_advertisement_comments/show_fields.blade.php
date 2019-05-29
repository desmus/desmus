<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $publicAdvertisementComment->id !!}</p>
</div>

<div class="form-group" style="text-align: justify; margin-right: 20px;">
  {!! Form::label('content', 'Content:') !!}
  <p>{!! $publicAdvertisementComment->content !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $publicAdvertisementComment->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $publicAdvertisementComment->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('public_advertisement_id', 'Public Advertisement Id:') !!}
  <p>{!! $publicAdvertisementComment->public_advertisement_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $publicAdvertisementComment->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $publicAdvertisementComment->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $publicAdvertisementComment->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $publicAdvertisementComment->updated_at !!}</p>
</div>