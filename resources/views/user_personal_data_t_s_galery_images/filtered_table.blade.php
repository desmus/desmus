<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleryImages-filtered_table">
    
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
      
      @foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
      
        <tr>
              
          <td> {!! $userPersonalDataTSGaleryImage->name !!} </td>
          <td> {!! $userPersonalDataTSGaleryImage->email !!} </td>
          <td> {!! $userPersonalDataTSGaleryImage->description !!} </td>
          <td> {!! $userPersonalDataTSGaleryImage->permissions !!}</td>
          <td> {!! $userPersonalDataTSGaleryImage->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTSGaleryImages.destroy', $userPersonalDataTSGaleryImage->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTSGaleryImages.edit', [$userPersonalDataTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>