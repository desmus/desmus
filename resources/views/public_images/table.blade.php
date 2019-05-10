<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="publicImages-table">
    
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
      
      @foreach($publicImages as $publicImage)
            
        <tr>
              
          <td>{!! $publicImage->name !!}</td>
          <td>{!! $publicImage->description !!}</td>
          <td>{!! $publicImage->file_type !!}</td>
          <td>{!! $publicImage->views_quantity !!}</td>
          <td>{!! $publicImage->updates_quantity !!}</td>
          <td>{!! $publicImage->status !!}</td>
          <td>{!! $publicImage->college_t_s_g_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('publicImages.show', [$publicImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>