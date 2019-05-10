<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopicUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopicUs as $userJobTopicU)
          
        <tr>
              
          <td>{!! $userJobTopicU->datetime !!}</td>
          <td>{!! $userJobTopicU->user_id !!}</td>
          <td>{!! $userJobTopicU->user_j_t_id !!}</td>
              
          <td>
              
            <div class='btn-group'>
              
              <a href="{!! route('userJobTopicUs.show', [$userJobTopicU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>