<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $recentActivityDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $recentActivityDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $recentActivityDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('recent_activity_id', 'Recent Activity Id:') !!}
  <p>{!! $recentActivityDelete->recent_activity_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $recentActivityDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $recentActivityDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $recentActivityDelete->updated_at !!}</p>
</div>