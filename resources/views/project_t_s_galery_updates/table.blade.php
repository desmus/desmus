<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryUpdates as $projectTSGaleryUpdate)
          
        <tr>
              
          <td>{!! $projectTSGaleryUpdate->actual_name !!}</td>
          <td>{!! $projectTSGaleryUpdate->past_name !!}</td>
          <td>{!! $projectTSGaleryUpdate->datetime !!}</td>
          <td>{!! $projectTSGaleryUpdate->user_id !!}</td>
          <td>{!! $projectTSGaleryUpdate->project_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSGaleryUpdates.show', [$projectTSGaleryUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>