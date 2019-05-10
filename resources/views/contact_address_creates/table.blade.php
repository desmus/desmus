<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactAddressCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Address Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactAddressCreates as $contactAddressCreate)
          
        <tr>
              
          <td>{!! $contactAddressCreate->datetime !!}</td>
          <td>{!! $contactAddressCreate->user_id !!}</td>
          <td>{!! $contactAddressCreate->contact_address_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactAddressCreates.show', [$contactAddressCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>