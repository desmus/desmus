<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectUpdates as $projectUpdate)
          
        <tr>
              
          <td>{!! $projectUpdate->actual_name !!}</td>
          <td>{!! $projectUpdate->past_name !!}</td>
          <td>{!! $projectUpdate->datetime !!}</td>
          <td>{!! $projectUpdate->user_id !!}</td>
          <td>{!! $projectUpdate->project_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectUpdates.show', [$projectUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>