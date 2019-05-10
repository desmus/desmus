<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>College T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFiles as $collegeTSToolFile)
          
        <tr>
              
          <td>{!! $collegeTSToolFile->name !!}</td>
          <td>{!! $collegeTSToolFile->description !!}</td>
          <td>{!! $collegeTSToolFile->file_type !!}</td>
          <td>{!! $collegeTSToolFile->views_quantity !!}</td>
          <td>{!! $collegeTSToolFile->updates_quantity !!}</td>
          <td>{!! $collegeTSToolFile->status !!}</td>
          <td>{!! $collegeTSToolFile->college_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFiles.show', [$collegeTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>