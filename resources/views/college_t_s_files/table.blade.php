<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFiles-table">
      
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
      
      @foreach($collegeTSFiles as $collegeTSFile)
          
        <tr>
              
          <td>{!! $collegeTSFile->name !!}</td>
          <td>{!! $collegeTSFile->description !!}</td>
          <td>{!! $collegeTSFile->file_type !!}</td>
          <td>{!! $collegeTSFile->views_quantity !!}</td>
          <td>{!! $collegeTSFile->updates_quantity !!}</td>
          <td>{!! $collegeTSFile->status !!}</td>
          <td>{!! $collegeTSFile->college_topic_section_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSFiles.show', [$collegeTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>