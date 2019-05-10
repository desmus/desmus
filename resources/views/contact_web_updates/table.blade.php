<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactWebUpdates-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Web Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($contactWebUpdates as $contactWebUpdates)
        
        <tr>
            
          <td>{!! $contactWebUpdates->datetime !!}</td>
          <td>{!! $contactWebUpdates->user_id !!}</td>
          <td>{!! $contactWebUpdates->contact_web_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactWebUpdates.show', [$contactWebUpdates->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>
  
</div>