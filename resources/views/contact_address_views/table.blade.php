<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactAddressViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Address Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($contactAddressViews as $contactAddressView)
          
        <tr>
              
          <td>{!! $contactAddressView->datetime !!}</td>
          <td>{!! $contactAddressView->user_id !!}</td>
          <td>{!! $contactAddressView->contact_address_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactAddressViews.show', [$contactAddressView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>