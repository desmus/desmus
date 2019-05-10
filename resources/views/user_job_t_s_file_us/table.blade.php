<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSFileUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSFileUs as $userJobTSFileU)
          
        <tr>
              
          <td>{!! $userJobTSFileU->datetime !!}</td>
          <td>{!! $userJobTSFileU->user_id !!}</td>
          <td>{!! $userJobTSFileU->user_j_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSFileUs.show', [$userJobTSFileU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>