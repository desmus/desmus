<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectDeletes as $projectDelete)
          
        <tr>
              
          <td>{!! $projectDelete->datetime !!}</td>
          <td>{!! $projectDelete->user_id !!}</td>
          <td>{!! $projectDelete->project_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectDeletes.show', [$projectDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>