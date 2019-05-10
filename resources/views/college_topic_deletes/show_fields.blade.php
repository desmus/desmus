<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeTopicDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeTopicDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeTopicDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('college_topic_id', 'College Topic Id:') !!}
  <p>{!! $collegeTopicDelete->college_topic_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeTopicDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeTopicDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeTopicDelete->updated_at !!}</p>
</div>