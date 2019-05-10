<table class="table table-hover table-bordered table-striped dataTable" id="collegeTSNotes-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($collegeTSNotes as $collegeTSNote)
    
      <tr>
            
        <td> <a href = "{!! route('collegeTSNotes.show', [$collegeTSNote->id]) !!}"> {!! $collegeTSNote->name !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['collegeTSNotes.destroy', $collegeTSNote->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('collegeTSNotes.show', [$collegeTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('collegeTSNotes.edit', [$collegeTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              <a href="{!! route('userCollegeTSNotes.show', [$collegeTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>