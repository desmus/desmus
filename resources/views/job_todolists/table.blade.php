<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTodolists as $jobTodolist)
          
        <tr>
              
          <td>{!! $jobTodolist->name !!}</td>
          <td>{!! $jobTodolist->description !!}</td>
          <td>{!! $jobTodolist->views_quantity !!}</td>
          <td>{!! $jobTodolist->updates_quantity !!}</td>
          <td>{!! $jobTodolist->status !!}</td>
          <td>{!! $jobTodolist->datetime !!}</td>
          <td>{!! $jobTodolist->job_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTodolists.show', [$jobTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>