<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryImageDeletes-table">
      
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryImageDeletes as $projectTSGaleryImageDelete)
          
        <tr>
              
          <td>{!! $projectTSGaleryImageDelete->datetime !!}</td>
          <td>{!! $projectTSGaleryImageDelete->user_id !!}</td>
          <td>{!! $projectTSGaleryImageDelete->project_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTSGaleryImageDeletes.show', [$projectTSGaleryImageDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>