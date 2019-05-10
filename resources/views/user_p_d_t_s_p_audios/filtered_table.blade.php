<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPDTSPAudios-filtered_table">
    
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
      
      @foreach($userPDTSPAudios as $userPDTSPAudio)
      
        <tr>
              
          <td> {!! $userPDTSPAudio->name !!} </td>
          <td> {!! $userPDTSPAudio->email !!} </td>
          <td> {!! $userPDTSPAudio->description !!} </td>
          <td> {!! $userPDTSPAudio->permissions !!}</td>
          <td> {!! $userPDTSPAudio->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPDTSPAudios.destroy', $userPDTSPAudio->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPDTSPAudios.edit', [$userPDTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>