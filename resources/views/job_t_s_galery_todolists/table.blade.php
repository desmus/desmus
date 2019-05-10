<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryTodolists-table">
      
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
      
      @foreach($jobTSGaleryTodolists as $jobTSGaleryTodolist)
          
        <tr>
              
          <td>{!! $jobTSGaleryTodolist->name !!}</td>
          <td>{!! $jobTSGaleryTodolist->description !!}</td>
          <td>{!! $jobTSGaleryTodolist->views_quantity !!}</td>
          <td>{!! $jobTSGaleryTodolist->updates_quantity !!}</td>
          <td>{!! $jobTSGaleryTodolist->status !!}</td>
          <td>{!! $jobTSGaleryTodolist->datetime !!}</td>
          <td>{!! $jobTSGaleryTodolist->job_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSGaleryTodolists.show', [$jobTSGaleryTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>