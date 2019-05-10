<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryImages-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryImage->name !!}</td>
          <td>{!! $personalDataTSGaleryImage->description !!}</td>
          <td>{!! $personalDataTSGaleryImage->file_type !!}</td>
          <td>{!! $personalDataTSGaleryImage->views_quantity !!}</td>
          <td>{!! $personalDataTSGaleryImage->updates_quantity !!}</td>
          <td>{!! $personalDataTSGaleryImage->status !!}</td>
          <td>{!! $personalDataTSGaleryImage->personalData_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGaleryImages.show', [$personalDataTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>