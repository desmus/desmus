<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCalendarEvents-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Calendar Event Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCalendarEvents as $userCalendarEvent)
          
        <tr>
              
          <td>{!! $userCalendarEvent->datetime !!}</td>
          <td>{!! $userCalendarEvent->description !!}</td>
          <td>{!! $userCalendarEvent->status !!}</td>
          <td>{!! $userCalendarEvent->permissions !!}</td>
          <td>{!! $userCalendarEvent->user_id !!}</td>
          <td>{!! $userCalendarEvent->calendar_event_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userCalendarEvents.show', [$userCalendarEvent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>