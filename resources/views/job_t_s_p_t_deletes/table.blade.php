<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPTDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPTDeletes as $jobTSPTDelete)
          
        <tr>
              
          <td>{!! $jobTSPTDelete->datetime !!}</td>
          <td>{!! $jobTSPTDelete->user_id !!}</td>
          <td>{!! $jobTSPTDelete->j_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSPTDeletes.show', [$jobTSPTDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>