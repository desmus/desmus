<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="calendarEvents-table">
      
    <thead>
          
      <tr>
        
        <th>Name</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>Finish Date</th>
        <th>Color</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($calendarEvents as $calendarEvent)
          
        <tr>
              
          <td>{!! $calendarEvent->name !!}</td>
          <td>{!! $calendarEvent->description !!}</td>
          <td>{!! $calendarEvent->start_date !!}</td>
          <td>{!! $calendarEvent->finish_date !!}</td>
          <td>{!! $calendarEvent->color !!}</td>
          <td>{!! $calendarEvent->views_quantity !!}</td>
          <td>{!! $calendarEvent->updates_quantity !!}</td>
          <td>{!! $calendarEvent->status !!}</td>
          <td>{!! $calendarEvent->user_id !!}</td>
          
          <td>
        
            <div class='btn-group'>
                      
              <a href="{!! route('calendarEvents.show', [$calendarEvent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>