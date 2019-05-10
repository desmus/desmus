<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFileTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>J T S F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileTodolists as $jobTSFileTodolist)
          
        <tr>
              
          <td>{!! $jobTSFileTodolist->name !!}</td>
          <td>{!! $jobTSFileTodolist->description !!}</td>
          <td>{!! $jobTSFileTodolist->views_quantity !!}</td>
          <td>{!! $jobTSFileTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSFileTodolist->status !!}</td>
          <td>{!! $jobTSFileTodolist->datetime !!}</td>
          <td>{!! $jobTSFileTodolist->c_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSFileTodolists.show', [$jobTSFileTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>