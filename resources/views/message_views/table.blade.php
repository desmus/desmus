<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="messageViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Message Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($messageViews as $messageView)
          
        <tr>
              
          <td>{!! $messageView->datetime !!}</td>
          <td>{!! $messageView->user_id !!}</td>
          <td>{!! $messageView->message_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('messageViews.show', [$messageView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>