<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactTelephoneCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Telephone Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactTelephoneCreates as $contactTelephoneCreate)
        
        <tr>
              
          <td>{!! $contactTelephoneCreate->datetime !!}</td>
          <td>{!! $contactTelephoneCreate->user_id !!}</td>
          <td>{!! $contactTelephoneCreate->contact_telephone_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactTelephoneCreates.show', [$contactTelephoneCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>