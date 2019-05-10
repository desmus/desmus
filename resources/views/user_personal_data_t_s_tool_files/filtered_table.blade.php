<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolFiles-filtered_table">
    
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
      
      @foreach($userPersonalDataTSToolFiles as $userPersonalDataTSToolFile)
      
        <tr>
              
          <td> {!! $userPersonalDataTSToolFile->name !!} </td>
          <td> {!! $userPersonalDataTSToolFile->email !!} </td>
          <td> {!! $userPersonalDataTSToolFile->description !!} </td>
          <td> {!! $userPersonalDataTSToolFile->permissions !!}</td>
          <td> {!! $userPersonalDataTSToolFile->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTSToolFiles.destroy', $userPersonalDataTSToolFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTSToolFiles.edit', [$userPersonalDataTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>