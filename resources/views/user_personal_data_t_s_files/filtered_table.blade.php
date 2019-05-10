<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSFiles-filtered_table">
    
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
      
      @foreach($userPersonalDataTSFiles as $userPersonalDataTSFile)
      
        <tr>
              
          <td> {!! $userPersonalDataTSFile->name !!} </td>
          <td> {!! $userPersonalDataTSFile->email !!} </td>
          <td> {!! $userPersonalDataTSFile->description !!} </td>
          <td> {!! $userPersonalDataTSFile->permissions !!}</td>
          <td> {!! $userPersonalDataTSFile->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTSFiles.destroy', $userPersonalDataTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTSFiles.edit', [$userPersonalDataTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>