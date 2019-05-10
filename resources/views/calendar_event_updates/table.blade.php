<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="calendarEventUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Calendar Event Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($calendarEventUpdates as $calendarEventUpdate)
          
        <tr>
              
          <td>{!! $calendarEventUpdate->actual_name !!}</td>
          <td>{!! $calendarEventUpdate->past_name !!}</td>
          <td>{!! $calendarEventUpdate->datetime !!}</td>
          <td>{!! $calendarEventUpdate->user_id !!}</td>
          <td>{!! $calendarEventUpdate->calendar_event_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('calendarEventUpdates.show', [$calendarEventUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>