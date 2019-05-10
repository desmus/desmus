<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSFiles-filtered_table">
    
    <thead>
          
      <tr>
              
        <th>Username</th>
        <th>Email</th>
        <th>Description</th>
        <th>Permissions</th>
        <th>Datetime</th>
        <th>Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSFiles as $userProjectTSFile)
      
        <tr>
              
          <td> {!! $userProjectTSFile->name !!} </td>
          <td> {!! $userProjectTSFile->email !!} </td>
          <td> {!! $userProjectTSFile->description !!} </td>
          <td> {!! $userProjectTSFile->permissions !!}</td>
          <td> {!! $userProjectTSFile->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSFiles.destroy', $userProjectTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
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