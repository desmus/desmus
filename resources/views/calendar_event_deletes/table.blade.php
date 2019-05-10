<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="calendarEventDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Calendar Event Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($calendarEventDeletes as $calendarEventDelete)
          
        <tr>
              
          <td>{!! $calendarEventDelete->datetime !!}</td>
          <td>{!! $calendarEventDelete->user_id !!}</td>
          <td>{!! $calendarEventDelete->calendar_event_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('calendarEventDeletes.show', [$calendarEventDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>