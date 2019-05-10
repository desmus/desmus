<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $recentActivityView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $recentActivityView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $recentActivityView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('recent_activity_id', 'Recent Activity Id:') !!}
  <p>{!! $recentActivityView->recent_activity_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $recentActivityView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $recentActivityView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $recentActivityView->updated_at !!}</p>
</div>