<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userCalendarEvent[0] -> permissions, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userCalendarEvent[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userCalendarEvent[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userCalendarEvent[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userCalendarEvent[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('calendar_event_id', 'CalendarEvent Id:') !!}
{!! Form::hidden('calendar_event_id', $userCalendarEvent[0] -> calendar_event_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userCalendarEvents.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>