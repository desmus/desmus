<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactTelephoneDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Telephone Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactTelephoneDeletes as $contactTelephoneDeletes)
          
        <tr>
              
          <td>{!! $contactTelephoneDeletes->datetime !!}</td>
          <td>{!! $contactTelephoneDeletes->user_id !!}</td>
          <td>{!! $contactTelephoneDeletes->contact_telephone_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('contactTelephoneDeletes.show', [$contactTelephoneDeletes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>