<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactSocialViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Social Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactSocialViews as $contactSocialView)
          
        <tr>
              
          <td>{!! $contactSocialView->datetime !!}</td>
          <td>{!! $contactSocialView->user_id !!}</td>
          <td>{!! $contactSocialView->contact_social_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('contactSocialViews.show', [$contactSocialView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>