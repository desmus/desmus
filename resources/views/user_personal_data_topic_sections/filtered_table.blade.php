<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTopicSections-filtered_table">
    
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
      
      @foreach($userPersonalDataTopicSections as $userPersonalDataTopicSection)
      
        <tr>
              
          <td> {!! $userPersonalDataTopicSection->name !!} </td>
          <td> {!! $userPersonalDataTopicSection->email !!} </td>
          <td> {!! $userPersonalDataTopicSection->description !!} </td>
          <td> {!! $userPersonalDataTopicSection->permissions !!}</td>
          <td> {!! $userPersonalDataTopicSection->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userPersonalDataTopicSections.destroy', $userPersonalDataTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userPersonalDataTopicSections.edit', [$userPersonalDataTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>