<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSTools-filtered_table">
    
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
      
      @foreach($userProjectTSTools as $userProjectTSTool)
      
        <tr>
              
          <td> {!! $userProjectTSTool->name !!} </td>
          <td> {!! $userProjectTSTool->email !!} </td>
          <td> {!! $userProjectTSTool->description !!} </td>
          <td> {!! $userProjectTSTool->permissions !!}</td>
          <td> {!! $userProjectTSTool->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSTools.destroy', $userProjectTSTool->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSTools.edit', [$userProjectTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>