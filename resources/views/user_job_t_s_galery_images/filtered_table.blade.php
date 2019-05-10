<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGaleryImages-filtered_table">
    
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
      
      @foreach($userJobTSGaleryImages as $userJobTSGaleryImage)
      
        <tr>
              
          <td> {!! $userJobTSGaleryImage->name !!} </td>
          <td> {!! $userJobTSGaleryImage->email !!} </td>
          <td> {!! $userJobTSGaleryImage->description !!} </td>
          <td> {!! $userJobTSGaleryImage->permissions !!}</td>
          <td> {!! $userJobTSGaleryImage->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSGaleryImages.destroy', $userJobTSGaleryImage->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSGaleryImages.edit', [$userJobTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>