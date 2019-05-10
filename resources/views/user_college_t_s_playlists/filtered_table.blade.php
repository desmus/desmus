<div class="table-responsive" style="margin-bottom: 0;">
  
  <table class="table table-bordered table-striped dataTable" id="userCollegeTSPlaylists-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userCollegeTSPlaylists as $userCollegeTSPlaylist)
      
        <tr>
              
          <td> {!! $userCollegeTSPlaylist->name !!} </td>
          <td> {!! $userCollegeTSPlaylist->email !!} </td>
          <td> {!! $userCollegeTSPlaylist->description !!} </td>
          <td> {!! $userCollegeTSPlaylist->permissions !!}</td>
          <td> {!! $userCollegeTSPlaylist->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userCollegeTSPlaylists.destroy', $userCollegeTSPlaylist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTSPlaylists.edit', [$userCollegeTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>