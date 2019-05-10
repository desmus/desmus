<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryImages-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>College T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
            
        <tr>
              
          <td>{!! $collegeTSGaleryImage->name !!}</td>
          <td>{!! $collegeTSGaleryImage->description !!}</td>
          <td>{!! $collegeTSGaleryImage->file_type !!}</td>
          <td>{!! $collegeTSGaleryImage->views_quantity !!}</td>
          <td>{!! $collegeTSGaleryImage->updates_quantity !!}</td>
          <td>{!! $collegeTSGaleryImage->status !!}</td>
          <td>{!! $collegeTSGaleryImage->college_t_s_g_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSGaleryImages.show', [$collegeTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>