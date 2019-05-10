<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="colleges-table" style="margin-bottom: 0;">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($colleges as $college)
          
        <tr>
              
          <td><a> <a href = "{!! route('colleges.show', [$college->id]) !!}"> {!! $college->name !!} </a> </td>
          <td>
                  
            {!! Form::open(['route' => ['colleges.destroy', $college->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('colleges.show', [$college->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('colleges.edit', [$college->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('userColleges.show', [$college->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
                
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>