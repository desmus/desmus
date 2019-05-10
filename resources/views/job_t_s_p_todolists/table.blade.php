<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>J T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPTodolists as $jobTSPTodolist)
          
        <tr>
              
          <td>{!! $jobTSPTodolist->name !!}</td>
          <td>{!! $jobTSPTodolist->description !!}</td>
          <td>{!! $jobTSPTodolist->views_quantity !!}</td>
          <td>{!! $jobTSPTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSPTodolist->status !!}</td>
          <td>{!! $jobTSPTodolist->datetime !!}</td>
          <td>{!! $jobTSPTodolist->j_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPTodolists.show', [$jobTSPTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>