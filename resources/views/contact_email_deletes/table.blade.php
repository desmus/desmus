<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactEmailDeletes-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Email Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($contactEmailDeletes as $contactEmailDeletes)
        
        <tr>
            
          <td>{!! $contactEmailDeletes->datetime !!}</td>
          <td>{!! $contactEmailDeletes->user_id !!}</td>
          <td>{!! $contactEmailDeletes->contact_email_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactEmailDeletes.show', [$contactEmailDeletes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>
  
</div>