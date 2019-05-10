<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPTDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPTDeletes as $projectTSPTDelete)
          
        <tr>
              
          <td>{!! $projectTSPTDelete->datetime !!}</td>
          <td>{!! $projectTSPTDelete->user_id !!}</td>
          <td>{!! $projectTSPTDelete->p_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSPTDeletes.show', [$projectTSPTDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>