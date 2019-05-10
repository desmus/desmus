<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactSocialCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Social Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactSocialCreates as $contactSocialCreate)
          
        <tr>
              
          <td>{!! $contactSocialCreate->datetime !!}</td>
          <td>{!! $contactSocialCreate->user_id !!}</td>
          <td>{!! $contactSocialCreate->contact_social_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('contactSocialCreates.show', [$contactSocialCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>