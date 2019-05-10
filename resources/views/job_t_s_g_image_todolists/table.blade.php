<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGImageTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>J T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($jobTSGImageTodolists as $jobTSGImageTodolist)
          
        <tr>
              
          <td>{!! $jobTSGImageTodolist->name !!}</td>
          <td>{!! $jobTSGImageTodolist->description !!}</td>
          <td>{!! $jobTSGImageTodolist->views_quantity !!}</td>
          <td>{!! $jobTSGImageTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSGImageTodolist->status !!}</td>
          <td>{!! $jobTSGImageTodolist->datetime !!}</td>
          <td>{!! $jobTSGImageTodolist->j_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTSGImageTodolists.show', [$jobTSGImageTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>