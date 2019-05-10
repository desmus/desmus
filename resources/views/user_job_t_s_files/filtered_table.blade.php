<div class="table-responsive" style="margin-bottom: 0;">

  <table class="table table-bordered table-striped dataTable" id="userJobTSFiles-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userJobTSFiles as $userJobTSFile)
      
        <tr>
              
          <td> {!! $userJobTSFile->name !!} </td>
          <td> {!! $userJobTSFile->email !!} </td>
          <td> {!! $userJobTSFile->description !!} </td>
          <td> {!! $userJobTSFile->permissions !!}</td>
          <td> {!! $userJobTSFile->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSFiles.destroy', $userJobTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
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