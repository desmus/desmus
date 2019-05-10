<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactWebDeletes-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Web Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactWebDeletes as $contactWebDeletes)
          
        <tr>
              
          <td>{!! $contactWebDeletes->datetime !!}</td>
          <td>{!! $contactWebDeletes->user_id !!}</td>
          <td>{!! $contactWebDeletes->contact_web_id !!}</td>
          
          <td>
            
            
            <div class='btn-group'>
                      
              <a href="{!! route('contactWebDeletes.show', [$contactWebDeletes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>