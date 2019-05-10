<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobs-table" style="margin-bottom: 0;">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($jobs as $job)
          
        <tr>
              
          <td><a> <a href = "{!! route('jobs.show', [$job->id]) !!}"> {!! $job->name !!} </a> </td>
          <td>
                  
            {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('jobs.show', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('jobs.edit', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('userJobs.show', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
                
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>