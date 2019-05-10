<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeTopicView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeTopicView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeTopicView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('college_topic_id', 'College Topic Id:') !!}
  <p>{!! $collegeTopicView->college_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeTopicView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeTopicView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeTopicView->updated_at !!}</p>
</div>