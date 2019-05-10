<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectCreates as $projectCreate)
          
        <tr>
              
          <td>{!! $projectCreate->datetime !!}</td>
          <td>{!! $projectCreate->user_id !!}</td>
          <td>{!! $projectCreate->project_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectCreates.show', [$projectCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>