<div class="table-responsive">

  <table class="table table-responsive" id="projectTSPTViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPTViews as $projectTSPTView)
          
        <tr>
              
          <td>{!! $projectTSPTView->datetime !!}</td>
          <td>{!! $projectTSPTView->user_id !!}</td>
          <td>{!! $projectTSPTView->p_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSPTViews.show', [$projectTSPTView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>