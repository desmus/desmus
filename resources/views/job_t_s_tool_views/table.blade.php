<div class="table-responsive">

  <table class="table table-responsive" id="jobTSToolViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolViews as $jobTSToolView)
          
        <tr>
              
          <td>{!! $jobTSToolView->datetime !!}</td>
          <td>{!! $jobTSToolView->user_id !!}</td>
          <td>{!! $jobTSToolView->job_t_s_tool_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSToolViews.show', [$jobTSToolView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>