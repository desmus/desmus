<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopicCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTopicCs as $userProjectTopicC)
          
        <tr>
              
          <td>{!! $userProjectTopicC->datetime !!}</td>
          <td>{!! $userProjectTopicC->user_id !!}</td>
          <td>{!! $userProjectTopicC->user_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTopicCs.show', [$userProjectTopicC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>