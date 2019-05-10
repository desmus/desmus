<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactSocials-table">
      
    <thead>
          
      <tr>
              
        <th>Link</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactSocials as $contactSocial)
          
        <tr>
              
          <td>{!! $contactSocial->link !!}</td>
          <td>{!! $contactSocial->contact_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactSocials.show', [$contactSocial->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>