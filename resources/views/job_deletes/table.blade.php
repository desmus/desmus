<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobDeletes as $jobDelete)
          
        <tr>
              
          <td>{!! $jobDelete->datetime !!}</td>
          <td>{!! $jobDelete->user_id !!}</td>
          <td>{!! $jobDelete->job_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobDeletes.show', [$jobDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>