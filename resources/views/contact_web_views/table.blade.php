<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactWebViews-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Web Id</th>
        <th colspan="3">Action</th>
      
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($contactWebViews as $contactWebView)
        
        <tr>
            
          <td>{!! $contactWebView->datetime !!}</td>
          <td>{!! $contactWebView->user_id !!}</td>
          <td>{!! $contactWebView->contact_web_id !!}</td>
            
          <td>
              
            <div class='btn-group'>
                
              <a href="{!! route('contactWebViews.show', [$contactWebView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
            </div>
            
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>
  
</div>