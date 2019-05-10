<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSToolFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSToolFileDs as $userProjectTSToolFileD)
          
        <tr>
              
          <td>{!! $userProjectTSToolFileD->datetime !!}</td>
          <td>{!! $userProjectTSToolFileD->user_id !!}</td>
          <td>{!! $userProjectTSToolFileD->user_p_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSToolFileDs.show', [$userProjectTSToolFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>