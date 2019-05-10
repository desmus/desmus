<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolTodolists-table">
      
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
      
      @foreach($jobTSToolTodolists as $jobTSToolTodolist)
          
        <tr>
              
          <td>{!! $jobTSToolTodolist->name !!}</td>
          <td>{!! $jobTSToolTodolist->description !!}</td>
          <td>{!! $jobTSToolTodolist->views_quantity !!}</td>
          <td>{!! $jobTSToolTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSToolTodolist->status !!}</td>
          <td>{!! $jobTSToolTodolist->datetime !!}</td>
          <td>{!! $jobTSToolTodolist->job_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSToolTodolists.show', [$jobTSToolTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>