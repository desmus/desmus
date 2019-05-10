<table class="table table-hover table-bordered table-striped dataTable" id="personalDataTopics-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($personalDataTopics as $personalDataTopic)
    
      <tr>
            
        <td> <a href = "{!! route('personalDataTopics.show', [$personalDataTopic->id]) !!}"> {!! $personalDataTopic->name !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['personalDataTopics.destroy', $personalDataTopic->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('personalDataTopics.show', [$personalDataTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('personalDataTopics.edit', [$personalDataTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              <a href="{!! route('userPersonalDataTopics.show', [$personalDataTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>