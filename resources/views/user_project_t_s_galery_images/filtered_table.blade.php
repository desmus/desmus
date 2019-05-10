<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSGaleryImages-filtered_table">
    
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
      
      @foreach($userProjectTSGaleryImages as $userProjectTSGaleryImage)
      
        <tr>
              
          <td> {!! $userProjectTSGaleryImage->name !!} </td>
          <td> {!! $userProjectTSGaleryImage->email !!} </td>
          <td> {!! $userProjectTSGaleryImage->description !!} </td>
          <td> {!! $userProjectTSGaleryImage->permissions !!}</td>
          <td> {!! $userProjectTSGaleryImage->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSGaleryImages.destroy', $userProjectTSGaleryImage->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSGaleryImages.edit', [$userProjectTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>