<div class="table-responsive" style="margin-bottom: 0;">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSTools-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userCollegeTSTools as $userCollegeTSTool)
      
        <tr>
              
          <td> {!! $userCollegeTSTool->name !!} </td>
          <td> {!! $userCollegeTSTool->email !!} </td>
          <td> {!! $userCollegeTSTool->description !!} </td>
          <td> {!! $userCollegeTSTool->permissions !!}</td>
          <td> {!! $userCollegeTSTool->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userCollegeTSTools.destroy', $userCollegeTSTool->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTSTools.edit', [$userCollegeTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>