<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSTools-filtered_table">
    
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
      
      @foreach($userPersonalDataTSTools as $userPersonalDataTSTool)
      
        <tr>
              
          <td> {!! $userPersonalDataTSTool->name !!} </td>
          <td> {!! $userPersonalDataTSTool->email !!} </td>
          <td> {!! $userPersonalDataTSTool->description !!} </td>
          <td> {!! $userPersonalDataTSTool->permissions !!}</td>
          <td> {!! $userPersonalDataTSTool->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTSTools.destroy', $userPersonalDataTSTool->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTSTools.edit', [$userPersonalDataTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>