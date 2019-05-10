<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicSections as $personalDataTopicSection)
          
        <tr>
              
          <td>{!! $personalDataTopicSection->name !!}</td>
          <td>{!! $personalDataTopicSection->user_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['personalDataTopicSections.destroy', $personalDataTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDataTopicSections.show', [$personalDataTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDataTopicSections.edit', [$personalDataTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>