<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="messageDeletes-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Message Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
    
      @foreach($messageDeletes as $messageDelete)
        
        <tr>
            
          <td>{!! $messageDelete->datetime !!}</td>
          <td>{!! $messageDelete->user_id !!}</td>
          <td>{!! $messageDelete->message_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                    
              <a href="{!! route('messageDeletes.show', [$messageDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>
  
</div>