<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSToolDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSToolDs as $userJobTSToolD)
          
        <tr>
              
          <td>{!! $userJobTSToolD->datetime !!}</td>
          <td>{!! $userJobTSToolD->user_id !!}</td>
          <td>{!! $userJobTSToolD->user_j_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSToolDs.show', [$userJobTSToolD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>