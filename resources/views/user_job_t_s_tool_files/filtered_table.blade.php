<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSToolFiles-filtered_table">
    
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
      
      @foreach($userJobTSToolFiles as $userJobTSToolFile)
      
        <tr>
              
          <td> {!! $userJobTSToolFile->name !!} </td>
          <td> {!! $userJobTSToolFile->email !!} </td>
          <td> {!! $userJobTSToolFile->description !!} </td>
          <td> {!! $userJobTSToolFile->permissions !!}</td>
          <td> {!! $userJobTSToolFile->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSToolFiles.destroy', $userJobTSToolFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSToolFiles.edit', [$userJobTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>