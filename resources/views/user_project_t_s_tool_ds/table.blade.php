<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSToolDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSToolDs as $userProjectTSToolD)
          
        <tr>
              
          <td>{!! $userProjectTSToolD->datetime !!}</td>
          <td>{!! $userProjectTSToolD->user_id !!}</td>
          <td>{!! $userProjectTSToolD->user_p_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSToolDs.show', [$userProjectTSToolD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>