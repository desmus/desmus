<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPTUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPTUpdates as $projectTSPTUpdate)
          
        <tr>
          
          <td>{!! $projectTSPTUpdate->actual_name !!}</td>
          <td>{!! $projectTSPTUpdate->past_name !!}</td>
          <td>{!! $projectTSPTUpdate->datetime !!}</td>
          <td>{!! $projectTSPTUpdate->user_id !!}</td>
          <td>{!! $projectTSPTUpdate->p_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSPTUpdates.show', [$projectTSPTUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>