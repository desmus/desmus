<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeTopicCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeTopicCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeTopicCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('college_topic_id', 'College Topic Id:') !!}
  <p>{!! $collegeTopicCreate->college_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeTopicCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeTopicCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeTopicCreate->updated_at !!}</p>
</div>