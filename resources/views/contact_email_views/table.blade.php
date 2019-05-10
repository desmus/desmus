<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactEmailViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Email Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactEmailViews as $contactEmailView)
          
        <tr>
              
          <td>{!! $contactEmailView->datetime !!}</td>
          <td>{!! $contactEmailView->user_id !!}</td>
          <td>{!! $contactEmailView->contact_email_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactEmailViews.show', [$contactEmailView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>