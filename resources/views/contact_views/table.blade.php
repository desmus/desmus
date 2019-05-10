<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactViews as $contactView)
          
        <tr>
              
          <td>{!! $contactView->datetime !!}</td>
          <td>{!! $contactView->user_id !!}</td>
          <td>{!! $contactView->contact_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactViews.show', [$contactView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>