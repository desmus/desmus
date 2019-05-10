<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>College Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryTodolists as $personalDataTSGaleryTodolist)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryTodolist->name !!}</td>
          <td>{!! $personalDataTSGaleryTodolist->description !!}</td>
          <td>{!! $personalDataTSGaleryTodolist->views_quantity !!}</td>
          <td>{!! $personalDataTSGaleryTodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTSGaleryTodolist->status !!}</td>
          <td>{!! $personalDataTSGaleryTodolist->datetime !!}</td>
          <td>{!! $personalDataTSGaleryTodolist->personal_data_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['personalDataTSGaleryTodolists.destroy', $personalDataTSGaleryTodolist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDataTSGaleryTodolists.show', [$personalDataTSGaleryTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDataTSGaleryTodolists.edit', [$personalDataTSGaleryTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>