<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDatas-filtered_table">
    
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
      
      @foreach($userPersonalDatas as $userPersonalData)
      
        <tr>
              
          <td> {!! $userPersonalData->name !!} </td>
          <td> {!! $userPersonalData->email !!} </td>
          <td> {!! $userPersonalData->description !!} </td>
          <td> {!! $userPersonalData->permissions !!}</td>
          <td> {!! $userPersonalData->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDatas.destroy', $userPersonalData->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDatas.edit', [$userPersonalData->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>