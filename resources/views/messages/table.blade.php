<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="messages-table">
    
    <thead>
      
      <tr>
        
        <th>Subject</th>
        <th>Content</th>
        <th>Views Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>Importance</th>
        <th>S User Id</th>
        <th>D User Id</th>
        <th colspan="3">Action</th>
        
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($messages as $message)
      
        <tr>
          
          <td>{!! $message->subject !!}</td>
          <td>{!! $message->content !!}</td>
          <td>{!! $message->views_quantity !!}</td>
          <td>{!! $message->status !!}</td>
          <td>{!! $message->datetime !!}</td>
          <td>{!! $message->importance !!}</td>
          <td>{!! $message->s_user_id !!}</td>
          <td>{!! $message->d_user_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                
              <a href="{!! route('messages.show', [$message->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
        
      @endforeach
      
    </tbody>
  
  </table>
  
</div>