<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="publicFiles-table">
      
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
      
      @foreach($publicFiles as $publicFile)
          
        <tr>
              
          <td>{!! $publicFile->name !!}</td>
          <td>{!! $publicFile->description !!}</td>
          <td>{!! $publicFile->file_type !!}</td>
          <td>{!! $publicFile->views_quantity !!}</td>
          <td>{!! $publicFile->updates_quantity !!}</td>
          <td>{!! $publicFile->status !!}</td>
          <!--<td>{!! $publicFile->college_topic_section_id !!}</td>-->
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('publicFiles.show', [$publicFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>