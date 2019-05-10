<div class="table-responsive">

  <table class="table table-responsive" id="projectTSToolViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolViews as $projectTSToolView)
          
        <tr>
              
          <td>{!! $projectTSToolView->datetime !!}</td>
          <td>{!! $projectTSToolView->user_id !!}</td>
          <td>{!! $projectTSToolView->project_t_s_tool_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSToolViews.show', [$projectTSToolView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>