<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactEmailUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Email Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactEmailUpdates as $contactEmailUpdates)
          
        <tr>
              
          <td>{!! $contactEmailUpdates->datetime !!}</td>
          <td>{!! $contactEmailUpdates->user_id !!}</td>
          <td>{!! $contactEmailUpdates->contact_email_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactEmailUpdates.show', [$contactEmailUpdates->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>