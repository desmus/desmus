<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileViews as $collegeTSToolFileView)
          
        <tr>
              
          <td>{!! $collegeTSToolFileView->datetime !!}</td>
          <td>{!! $collegeTSToolFileView->user_id !!}</td>
          <td>{!! $collegeTSToolFileView->college_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileViews.show', [$collegeTSToolFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>