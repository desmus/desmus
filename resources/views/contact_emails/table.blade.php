<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactEmails-table">
    
    <thead>
      
      <tr>
            
        <th>Email</th>
        <th>Type</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($contactEmails as $contactEmail)
      
        <tr>
            
          <td>{!! $contactEmail->email !!}</td>
          <td>{!! $contactEmail->type !!}</td>
          <td>{!! $contactEmail->contact_id !!}</td>
            
          <td>
          
            <div class='btn-group'>
            
              <a href="{!! route('contactEmails.show', [$contactEmail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>
  
</div>