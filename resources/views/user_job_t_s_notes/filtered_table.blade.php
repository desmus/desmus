<div class="table-responsive" style="margin-bottom: 0;">

  <table class="table table-bordered table-striped dataTable" id="userJobTSNotes-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userJobTSNotes as $userJobTSNote)
      
        <tr>
              
          <td> {!! $userJobTSNote->name !!} </td>
          <td> {!! $userJobTSNote->email !!} </td>
          <td> {!! $userJobTSNote->description !!} </td>
          <td> {!! $userJobTSNote->permissions !!}</td>
          <td> {!! $userJobTSNote->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSNotes.destroy', $userJobTSNote->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSNotes.edit', [$userJobTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>