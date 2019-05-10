<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactSocialUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Social Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactSocialUpdates as $contactSocialUpdates)
          
        <tr>
              
          <td>{!! $contactSocialUpdates->datetime !!}</td>
          <td>{!! $contactSocialUpdates->user_id !!}</td>
          <td>{!! $contactSocialUpdates->contact_social_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactSocialUpdates.show', [$contactSocialUpdates->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>