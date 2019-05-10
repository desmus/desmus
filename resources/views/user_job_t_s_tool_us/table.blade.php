<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSToolUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSToolUs as $userJobTSToolU)
          
        <tr>
              
          <td>{!! $userJobTSToolU->datetime !!}</td>
          <td>{!! $userJobTSToolU->user_id !!}</td>
          <td>{!! $userJobTSToolU->user_j_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSToolUs.show', [$userJobTSToolU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>