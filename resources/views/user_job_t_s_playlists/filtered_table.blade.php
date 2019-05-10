<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="userJobTSPlaylists-filtered_table">
    
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
      
      @foreach($userJobTSPlaylists as $userJobTSPlaylist)
      
        <tr>
              
          <td> {!! $userJobTSPlaylist->name !!} </td>
          <td> {!! $userJobTSPlaylist->email !!} </td>
          <td> {!! $userJobTSPlaylist->description !!} </td>
          <td> {!! $userJobTSPlaylist->permissions !!}</td>
          <td> {!! $userJobTSPlaylist->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSPlaylists.destroy', $userJobTSPlaylist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSPlaylists.edit', [$userJobTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>