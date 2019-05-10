<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="messageCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Message Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($messageCreates as $messageCreate)
          
        <tr>
              
          <td>{!! $messageCreate->datetime !!}</td>
          <td>{!! $messageCreate->user_id !!}</td>
          <td>{!! $messageCreate->message_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('messageCreates.show', [$messageCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>