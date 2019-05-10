<div class="table-responsive" style="margin-bottom: 0;">
  
  <table class="table table-bordered table-striped dataTable" id="userJobTSGaleries-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userJobTSGaleries as $userJobTSGalerie)
      
        <tr>
              
          <td> {!! $userJobTSGalerie->name !!} </td>
          <td> {!! $userJobTSGalerie->email !!} </td>
          <td> {!! $userJobTSGalerie->description !!} </td>
          <td> {!! $userJobTSGalerie->permissions !!}</td>
          <td> {!! $userJobTSGalerie->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTSGaleries.destroy', $userJobTSGalerie->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTSGaleries.edit', [$userJobTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>