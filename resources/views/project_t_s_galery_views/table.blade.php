<table class="table table-responsive" id="projectTSGaleryViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Project T S Galery Id</th>
      <th colspan="3">Action</th>
        
    </tr>
  
  </thead>
    
  <tbody>
    
    @foreach($projectTSGaleryViews as $projectTSGaleryView)
        
      <tr>
        
        <td>{!! $projectTSGaleryView->datetime !!}</td>
        <td>{!! $projectTSGaleryView->user_id !!}</td>
        <td>{!! $projectTSGaleryView->project_t_s_galery_id !!}</td>
            
        <td>
          
          <div class='btn-group'>
            
            <a href="{!! route('projectTSGaleryViews.show', [$projectTSGaleryView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
          </div>
        
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>