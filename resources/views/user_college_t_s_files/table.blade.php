<div class="table-responsive">
  
  <table class="table table-responsive" id="userCollegeTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSFiles as $userCollegeTSFile)
          
        <tr>
              
          <td>{!! $userCollegeTSFile->datetime !!}</td>
          <td>{!! $userCollegeTSFile->description !!}</td>
          <td>{!! $userCollegeTSFile->status !!}</td>
          <td>{!! $userCollegeTSFile->permissions !!}</td>
          <td>{!! $userCollegeTSFile->user_id !!}</td>
          <td>{!! $userCollegeTSFile->college_t_s_file_id !!}</td>
              
          <td>
            
            {!! Form::open(['route' => ['userCollegeTSFiles.destroy', $userCollegeTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTSFiles.show', [$userCollegeTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('userCollegeTSFiles.edit', [$userCollegeTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>