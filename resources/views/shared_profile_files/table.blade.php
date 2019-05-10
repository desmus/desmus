<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="sharedProfileFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($sharedProfileFiles as $sharedProfileFile)
          
        <tr>
              
          <td>{!! $sharedProfileFile->name !!}</td>
          <td>{!! $sharedProfileFile->description !!}</td>
          <td>{!! $sharedProfileFile->file_type !!}</td>
          <td>{!! $sharedProfileFile->views_quantity !!}</td>
          <td>{!! $sharedProfileFile->updates_quantity !!}</td>
          <td>{!! $sharedProfileFile->status !!}</td>
          <!--<td>{!! $sharedProfileFile->college_topic_section_id !!}</td>-->
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('sharedProfileFiles.show', [$sharedProfileFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>