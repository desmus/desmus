<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="calendarEventViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Calendar Event Id</th>
        <th colspan="3">Action</th>
        
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($calendarEventViews as $calendarEventView)
          
        <tr>
              
          <td>{!! $calendarEventView->datetime !!}</td>
          <td>{!! $calendarEventView->user_id !!}</td>
          <td>{!! $calendarEventView->calendar_event_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('calendarEventViews.show', [$calendarEventView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                  
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>