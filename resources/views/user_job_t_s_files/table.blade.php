<div class="table-responsive">
  
  <table class="table table-responsive" id="userJobTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSFiles as $userJobTSFile)
          
        <tr>
              
          <td>{!! $userJobTSFile->datetime !!}</td>
          <td>{!! $userJobTSFile->description !!}</td>
          <td>{!! $userJobTSFile->status !!}</td>
          <td>{!! $userJobTSFile->permissions !!}</td>
          <td>{!! $userJobTSFile->user_id !!}</td>
          <td>{!! $userJobTSFile->job_t_s_file_id !!}</td>
              
          <td>
            
            {!! Form::open(['route' => ['userJobTSFiles.destroy', $userJobTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSFiles.show', [$userJobTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('userJobTSFiles.edit', [$userJobTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>