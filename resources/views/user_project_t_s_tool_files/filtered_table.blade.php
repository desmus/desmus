<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSToolFiles-filtered_table">
    
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
      
      @foreach($userProjectTSToolFiles as $userProjectTSToolFile)
      
        <tr>
              
          <td> {!! $userProjectTSToolFile->name !!} </td>
          <td> {!! $userProjectTSToolFile->email !!} </td>
          <td> {!! $userProjectTSToolFile->description !!} </td>
          <td> {!! $userProjectTSToolFile->permissions !!}</td>
          <td> {!! $userProjectTSToolFile->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSToolFiles.destroy', $userProjectTSToolFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSToolFiles.edit', [$userProjectTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>