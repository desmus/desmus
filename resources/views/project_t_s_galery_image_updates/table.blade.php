<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryImageUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryImageUpdates as $projectTSGaleryImageUpdate)
          
        <tr>
              
          <td>{!! $projectTSGaleryImageUpdate->actual_name !!}</td>
          <td>{!! $projectTSGaleryImageUpdate->past_name !!}</td>
          <td>{!! $projectTSGaleryImageUpdate->datetime !!}</td>
          <td>{!! $projectTSGaleryImageUpdate->user_id !!}</td>
          <td>{!! $projectTSGaleryImageUpdate->project_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSGaleryImageUpdates.show', [$projectTSGaleryImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>