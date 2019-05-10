<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSNotes-filtered_table">
    
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
      
      @foreach($userProjectTSNotes as $userProjectTSNote)
      
        <tr>
              
          <td> {!! $userProjectTSNote->name !!} </td>
          <td> {!! $userProjectTSNote->email !!} </td>
          <td> {!! $userProjectTSNote->description !!} </td>
          <td> {!! $userProjectTSNote->permissions !!}</td>
          <td> {!! $userProjectTSNote->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTSNotes.destroy', $userProjectTSNote->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTSNotes.edit', [$userProjectTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>