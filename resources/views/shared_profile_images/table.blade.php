<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="sharedProfileImages-table">
    
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
      
      @foreach($sharedProfileImages as $sharedProfileImage)
            
        <tr>
              
          <td>{!! $sharedProfileImage->name !!}</td>
          <td>{!! $sharedProfileImage->description !!}</td>
          <td>{!! $sharedProfileImage->file_type !!}</td>
          <td>{!! $sharedProfileImage->views_quantity !!}</td>
          <td>{!! $sharedProfileImage->updates_quantity !!}</td>
          <td>{!! $sharedProfileImage->status !!}</td>
          <td>{!! $sharedProfileImage->college_t_s_g_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('sharedProfileImages.show', [$sharedProfileImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>