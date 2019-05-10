<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTopics-filtered_table">
    
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
      
      @foreach($userPersonalDataTopics as $userPersonalDataTopic)
      
        <tr>
              
          <td> {!! $userPersonalDataTopic->name !!} </td>
          <td> {!! $userPersonalDataTopic->email !!} </td>
          <td> {!! $userPersonalDataTopic->description !!} </td>
          <td> {!! $userPersonalDataTopic->permissions !!}</td>
          <td> {!! $userPersonalDataTopic->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTopics.destroy', $userPersonalDataTopic->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTopics.edit', [$userPersonalDataTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>