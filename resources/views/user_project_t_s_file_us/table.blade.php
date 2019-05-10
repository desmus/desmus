<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSFileUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSFileUs as $userProjectTSFileU)
          
        <tr>
              
          <td>{!! $userProjectTSFileU->datetime !!}</td>
          <td>{!! $userProjectTSFileU->user_id !!}</td>
          <td>{!! $userProjectTSFileU->user_p_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSFileUs.show', [$userProjectTSFileU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>