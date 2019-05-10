<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactEmailCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Email Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactEmailCreates as $contactEmailCreate)
        
        <tr>
              
          <td>{!! $contactEmailCreate->datetime !!}</td>
          <td>{!! $contactEmailCreate->user_id !!}</td>
          <td>{!! $contactEmailCreate->contact_email_id !!}</td>
              
          <td>
              
            <div class='btn-group'>
              
              <a href="{!! route('contactEmailCreates.show', [$contactEmailCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>