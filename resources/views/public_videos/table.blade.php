<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="publicVideos-table">
      
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
      
      @foreach($publicVideos as $publicVideo)
          
        <tr>
              
          <td>{!! $publicVideo->name !!}</td>
          <td>{!! $publicVideo->description !!}</td>
          <td>{!! $publicVideo->file_type !!}</td>
          <td>{!! $publicVideo->views_quantity !!}</td>
          <td>{!! $publicVideo->updates_quantity !!}</td>
          <td>{!! $publicVideo->status !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('publicVideos.show', [$publicVideo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>