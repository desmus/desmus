<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSPAudios-filtered_table">
    
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
      
      @foreach($userProjectTSPAudios as $userProjectTSPAudio)
      
        <tr>
              
          <td> {!! $userProjectTSPAudio->name !!} </td>
          <td> {!! $userProjectTSPAudio->email !!} </td>
          <td> {!! $userProjectTSPAudio->description !!} </td>
          <td> {!! $userProjectTSPAudio->permissions !!}</td>
          <td> {!! $userProjectTSPAudio->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSPAudios.destroy', $userProjectTSPAudio->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSPAudios.edit', [$userProjectTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>