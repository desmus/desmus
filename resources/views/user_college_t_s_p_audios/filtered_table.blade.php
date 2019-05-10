<div class="table-responsive" style="margin-bottom: 0;">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSPAudios-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userCollegeTSPAudios as $userCollegeTSPAudio)
      
        <tr>
              
          <td> {!! $userCollegeTSPAudio->name !!} </td>
          <td> {!! $userCollegeTSPAudio->email !!} </td>
          <td> {!! $userCollegeTSPAudio->description !!} </td>
          <td> {!! $userCollegeTSPAudio->permissions !!}</td>
          <td> {!! $userCollegeTSPAudio->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userCollegeTSPAudios.destroy', $userCollegeTSPAudio->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTSPAudios.edit', [$userCollegeTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>