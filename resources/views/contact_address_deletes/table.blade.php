<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactAddressDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Address Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactAddressDeletes as $contactAddressDeletes)
          
        <tr>
              
          <td>{!! $contactAddressDeletes->datetime !!}</td>
          <td>{!! $contactAddressDeletes->user_id !!}</td>
          <td>{!! $contactAddressDeletes->contact_address_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactAddressDeletes.show', [$contactAddressDeletes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>