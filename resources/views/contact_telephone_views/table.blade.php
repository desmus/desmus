<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactTelephoneViews-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Telephone Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactTelephoneViews as $contactTelephoneView)
          
        <tr>
              
          <td>{!! $contactTelephoneView->datetime !!}</td>
          <td>{!! $contactTelephoneView->user_id !!}</td>
          <td>{!! $contactTelephoneView->contact_telephone_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactTelephoneViews.show', [$contactTelephoneView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>