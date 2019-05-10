<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Personal Data T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolFiles as $personalDataTSToolFile)
          
        <tr>
              
          <td>{!! $personalDataTSToolFile->name !!}</td>
          <td>{!! $personalDataTSToolFile->description !!}</td>
          <td>{!! $personalDataTSToolFile->file_type !!}</td>
          <td>{!! $personalDataTSToolFile->views_quantity !!}</td>
          <td>{!! $personalDataTSToolFile->updates_quantity !!}</td>
          <td>{!! $personalDataTSToolFile->status !!}</td>
          <td>{!! $personalDataTSToolFile->personalData_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolFiles.show', [$personalDataTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>