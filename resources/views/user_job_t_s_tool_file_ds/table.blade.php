<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSToolFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSToolFileDs as $userJobTSToolFileD)
          
        <tr>
              
          <td>{!! $userJobTSToolFileD->datetime !!}</td>
          <td>{!! $userJobTSToolFileD->user_id !!}</td>
          <td>{!! $userJobTSToolFileD->user_j_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSToolFileDs.show', [$userJobTSToolFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>