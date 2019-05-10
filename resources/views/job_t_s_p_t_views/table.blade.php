<div class="table-responsive">

  <table class="table table-responsive" id="jobTSPTViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPTViews as $jobTSPTView)
          
        <tr>
              
          <td>{!! $jobTSPTView->datetime !!}</td>
          <td>{!! $jobTSPTView->user_id !!}</td>
          <td>{!! $jobTSPTView->j_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPTViews.show', [$jobTSPTView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>