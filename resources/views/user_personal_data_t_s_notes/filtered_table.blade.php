<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSNotes-filtered_table">
    
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
      
      @foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
      
        <tr>
              
          <td> {!! $userPersonalDataTSNote->name !!} </td>
          <td> {!! $userPersonalDataTSNote->email !!} </td>
          <td> {!! $userPersonalDataTSNote->description !!} </td>
          <td> {!! $userPersonalDataTSNote->permissions !!}</td>
          <td> {!! $userPersonalDataTSNote->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTSNotes.destroy', $userPersonalDataTSNote->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTSNotes.edit', [$userPersonalDataTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>