<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactTelephoneUpdates-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Telephone Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($contactTelephoneUpdates as $contactTelephoneUpdates)
        
        <tr>
            
          <td>{!! $contactTelephoneUpdates->datetime !!}</td>
          <td>{!! $contactTelephoneUpdates->user_id !!}</td>
          <td>{!! $contactTelephoneUpdates->contact_telephone_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
                    
              <a href="{!! route('contactTelephoneUpdates.show', [$contactTelephoneUpdates->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>

</div>