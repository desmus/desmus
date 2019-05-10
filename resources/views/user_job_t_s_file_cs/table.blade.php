<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSFileCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSFileCs as $userJobTSFileC)
          
        <tr>
              
          <td>{!! $userJobTSFileC->datetime !!}</td>
          <td>{!! $userJobTSFileC->user_id !!}</td>
          <td>{!! $userJobTSFileC->user_j_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSFileCs.show', [$userJobTSFileC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>