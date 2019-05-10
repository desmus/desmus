<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $recentActivityUpdate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $recentActivityUpdate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $recentActivityUpdate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('recent_activity_id', 'Recent Activity Id:') !!}
  <p>{!! $recentActivityUpdate->recent_activity_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $recentActivityUpdate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $recentActivityUpdate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $recentActivityUpdate->updated_at !!}</p>
</div>