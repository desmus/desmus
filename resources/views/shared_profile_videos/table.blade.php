<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="sharedProfileVideos-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($sharedProfileVideos as $sharedProfileVideo)
          
        <tr>
              
          <td>{!! $sharedProfileVideo->name !!}</td>
          <td>{!! $sharedProfileVideo->description !!}</td>
          <td>{!! $sharedProfileVideo->file_type !!}</td>
          <td>{!! $sharedProfileVideo->views_quantity !!}</td>
          <td>{!! $sharedProfileVideo->updates_quantity !!}</td>
          <td>{!! $sharedProfileVideo->status !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>