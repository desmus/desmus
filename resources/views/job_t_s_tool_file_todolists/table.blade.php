<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>J T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileTodolists as $jobTSToolFileTodolist)
          
        <tr>
              
          <td>{!! $jobTSToolFileTodolist->name !!}</td>
          <td>{!! $jobTSToolFileTodolist->description !!}</td>
          <td>{!! $jobTSToolFileTodolist->views_quantity !!}</td>
          <td>{!! $jobTSToolFileTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSToolFileTodolist->status !!}</td>
          <td>{!! $jobTSToolFileTodolist->datetime !!}</td>
          <td>{!! $jobTSToolFileTodolist->j_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileTodolists.show', [$jobTSToolFileTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>