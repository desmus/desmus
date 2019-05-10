<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactWebCreates-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Web Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($contactWebCreates as $contactWebCreate)
        
        <tr>
            
          <td>{!! $contactWebCreate->datetime !!}</td>
          <td>{!! $contactWebCreate->user_id !!}</td>
          <td>{!! $contactWebCreate->contact_web_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactWebCreates.show', [$contactWebCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>
    
  </table>

</div>