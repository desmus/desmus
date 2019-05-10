<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopicCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopicCs as $userJobTopicC)
          
        <tr>
              
          <td>{!! $userJobTopicC->datetime !!}</td>
          <td>{!! $userJobTopicC->user_id !!}</td>
          <td>{!! $userJobTopicC->user_j_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTopicCs.show', [$userJobTopicC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>