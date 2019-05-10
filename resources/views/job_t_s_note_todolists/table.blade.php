<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteTodolists-table">
      
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
      
      @foreach($jobTSNoteTodolists as $jobTSNoteTodolist)
          
        <tr>
              
          <td>{!! $jobTSNoteTodolist->name !!}</td>
          <td>{!! $jobTSNoteTodolist->description !!}</td>
          <td>{!! $jobTSNoteTodolist->views_quantity !!}</td>
          <td>{!! $jobTSNoteTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSNoteTodolist->status !!}</td>
          <td>{!! $jobTSNoteTodolist->datetime !!}</td>
          <td>{!! $jobTSNoteTodolist->job_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNoteTodolists.show', [$jobTSNoteTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>