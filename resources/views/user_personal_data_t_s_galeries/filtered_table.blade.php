<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleries-filtered_table">
    
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
      
      @foreach($userPersonalDataTSGaleries as $userPersonalDataTSGalerie)
      
        <tr>
              
          <td> {!! $userPersonalDataTSGalerie->name !!} </td>
          <td> {!! $userPersonalDataTSGalerie->email !!} </td>
          <td> {!! $userPersonalDataTSGalerie->description !!} </td>
          <td> {!! $userPersonalDataTSGalerie->permissions !!}</td>
          <td> {!! $userPersonalDataTSGalerie->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTSGaleries.destroy', $userPersonalDataTSGalerie->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTSGaleries.edit', [$userPersonalDataTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>