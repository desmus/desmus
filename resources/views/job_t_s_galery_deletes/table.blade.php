<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryDeletes-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Galery Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryDeletes as $jobTSGaleryDelete)
          
        <tr>
              
          <td>{!! $jobTSGaleryDelete->datetime !!}</td>
          <td>{!! $jobTSGaleryDelete->user_id !!}</td>
          <td>{!! $jobTSGaleryDelete->job_t_s_galery_id !!}</td>
              
          <td>
            
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGaleryDeletes.show', [$jobTSGaleryDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>