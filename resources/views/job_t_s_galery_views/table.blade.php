<table class="table table-responsive" id="jobTSGaleryViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Job T S Galery Id</th>
      <th colspan="3">Action</th>
        
    </tr>
  
  </thead>
    
  <tbody>
    
    @foreach($jobTSGaleryViews as $jobTSGaleryView)
        
      <tr>
        
        <td>{!! $jobTSGaleryView->datetime !!}</td>
        <td>{!! $jobTSGaleryView->user_id !!}</td>
        <td>{!! $jobTSGaleryView->job_t_s_galery_id !!}</td>
            
        <td>
          
          <div class='btn-group'>
            
            <a href="{!! route('jobTSGaleryViews.show', [$jobTSGaleryView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
          </div>
        
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>