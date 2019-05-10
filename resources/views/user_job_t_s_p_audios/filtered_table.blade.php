<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSPAudios-filtered_table">
    
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
      
      @foreach($userJobTSPAudios as $userJobTSPAudio)
      
        <tr>
              
          <td> {!! $userJobTSPAudio->name !!} </td>
          <td> {!! $userJobTSPAudio->email !!} </td>
          <td> {!! $userJobTSPAudio->description !!} </td>
          <td> {!! $userJobTSPAudio->permissions !!}</td>
          <td> {!! $userJobTSPAudio->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSPAudios.destroy', $userJobTSPAudio->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSPAudios.edit', [$userJobTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>