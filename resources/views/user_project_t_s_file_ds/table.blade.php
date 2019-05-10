<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSFileDs as $userProjectTSFileD)
          
        <tr>
              
          <td>{!! $userProjectTSFileD->datetime !!}</td>
          <td>{!! $userProjectTSFileD->user_id !!}</td>
          <td>{!! $userProjectTSFileD->user_p_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSFileDs.show', [$userProjectTSFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>