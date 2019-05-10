<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobCreates as $jobCreate)
          
        <tr>
              
          <td>{!! $jobCreate->datetime !!}</td>
          <td>{!! $jobCreate->user_id !!}</td>
          <td>{!! $jobCreate->job_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobCreates.show', [$jobCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>