<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectViews as $projectView)
          
        <tr>
              
          <td>{!! $projectView->datetime !!}</td>
          <td>{!! $projectView->user_id !!}</td>
          <td>{!! $projectView->project_id !!}</td>
              
          <td>
            
              <div class='btn-group'>
                      
                <a href="{!! route('projectViews.show', [$projectView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
              </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>