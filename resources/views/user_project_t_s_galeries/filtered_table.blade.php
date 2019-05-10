<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSGaleries-filtered_table">
    
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
      
      @foreach($userProjectTSGaleries as $userProjectTSGalerie)
      
        <tr>
              
          <td> {!! $userProjectTSGalerie->name !!} </td>
          <td> {!! $userProjectTSGalerie->email !!} </td>
          <td> {!! $userProjectTSGalerie->description !!} </td>
          <td> {!! $userProjectTSGalerie->permissions !!}</td>
          <td> {!! $userProjectTSGalerie->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSGaleries.destroy', $userProjectTSGalerie->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSGaleries.edit', [$userProjectTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>