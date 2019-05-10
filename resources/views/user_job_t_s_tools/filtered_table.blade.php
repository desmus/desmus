<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSTools-filtered_table">
    
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
      
      @foreach($userJobTSTools as $userJobTSTool)
      
        <tr>
              
          <td> {!! $userJobTSTool->name !!} </td>
          <td> {!! $userJobTSTool->email !!} </td>
          <td> {!! $userJobTSTool->description !!} </td>
          <td> {!! $userJobTSTool->permissions !!}</td>
          <td> {!! $userJobTSTool->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSTools.destroy', $userJobTSTool->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSTools.edit', [$userJobTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>