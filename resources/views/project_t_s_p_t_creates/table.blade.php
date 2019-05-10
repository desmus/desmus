<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPTCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPTCreates as $projectTSPTCreate)
          
        <tr>
              
          <td>{!! $projectTSPTCreate->datetime !!}</td>
          <td>{!! $projectTSPTCreate->user_id !!}</td>
          <td>{!! $projectTSPTCreate->p_t_s_p_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSPTCreates.show', [$projectTSPTCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>