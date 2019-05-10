<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="contactAddressUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Address Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactAddressUpdates as $contactAddressUpdates)
        
        <tr>
              
          <td>{!! $contactAddressUpdates->datetime !!}</td>
          <td>{!! $contactAddressUpdates->user_id !!}</td>
          <td>{!! $contactAddressUpdates->contact_address_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactAddressUpdates.show', [$contactAddressUpdates->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>