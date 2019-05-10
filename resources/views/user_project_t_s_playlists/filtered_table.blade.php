<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="userProjectTSPlaylists-filtered_table">
    
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
      
      @foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
      
        <tr>
              
          <td> {!! $userProjectTSPlaylist->name !!} </td>
          <td> {!! $userProjectTSPlaylist->email !!} </td>
          <td> {!! $userProjectTSPlaylist->description !!} </td>
          <td> {!! $userProjectTSPlaylist->permissions !!}</td>
          <td> {!! $userProjectTSPlaylist->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSPlaylists.destroy', $userProjectTSPlaylist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSPlaylists.edit', [$userProjectTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>