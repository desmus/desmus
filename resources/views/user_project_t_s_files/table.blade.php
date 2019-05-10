<div class="table-responsive">
  
  <table class="table table-responsive" id="userProjectTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSFiles as $userProjectTSFile)
          
        <tr>
              
          <td>{!! $userProjectTSFile->datetime !!}</td>
          <td>{!! $userProjectTSFile->description !!}</td>
          <td>{!! $userProjectTSFile->status !!}</td>
          <td>{!! $userProjectTSFile->permissions !!}</td>
          <td>{!! $userProjectTSFile->user_id !!}</td>
          <td>{!! $userProjectTSFile->project_t_s_file_id !!}</td>
              
          <td>
            
            {!! Form::open(['route' => ['userProjectTSFiles.destroy', $userProjectTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSFiles.show', [$userProjectTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('userProjectTSFiles.edit', [$userProjectTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>