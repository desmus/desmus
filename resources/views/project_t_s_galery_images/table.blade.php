<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryImages-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Project T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryImages as $projectTSGaleryImage)
            
        <tr>
              
          <td>{!! $projectTSGaleryImage->name !!}</td>
          <td>{!! $projectTSGaleryImage->description !!}</td>
          <td>{!! $projectTSGaleryImage->file_type !!}</td>
          <td>{!! $projectTSGaleryImage->views_quantity !!}</td>
          <td>{!! $projectTSGaleryImage->updates_quantity !!}</td>
          <td>{!! $projectTSGaleryImage->status !!}</td>
          <td>{!! $projectTSGaleryImage->project_t_s_g_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTSGaleryImages.show', [$projectTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>