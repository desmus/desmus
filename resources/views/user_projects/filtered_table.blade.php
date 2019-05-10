<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjects-filtered_table">
    
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
      
      @foreach($userProjects as $userProject)
      
        <tr>
              
          <td> {!! $userProject->name !!} </td>
          <td> {!! $userProject->email !!} </td>
          <td> {!! $userProject->description !!} </td>
          <td> {!! $userProject->permissions !!}</td>
          <td> {!! $userProject->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjects.destroy', $userProject->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjects.edit', [$userProject->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>