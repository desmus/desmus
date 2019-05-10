<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobViews as $jobView)
          
        <tr>
              
          <td>{!! $jobView->datetime !!}</td>
          <td>{!! $jobView->user_id !!}</td>
          <td>{!! $jobView->job_id !!}</td>
              
          <td>
            
              <div class='btn-group'>
                      
                <a href="{!! route('jobViews.show', [$jobView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
              </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>