<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>Personal Data Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTodolists as $personalDataTodolist)
          
        <tr>
              
          <td>{!! $personalDataTodolist->name !!}</td>
          <td>{!! $personalDataTodolist->description !!}</td>
          <td>{!! $personalDataTodolist->views_quantity !!}</td>
          <td>{!! $personalDataTodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTodolist->status !!}</td>
          <td>{!! $personalDataTodolist->datetime !!}</td>
          <td>{!! $personalDataTodolist->personal_data_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['personalDataTodolists.destroy', $personalDataTodolist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDataTodolists.show', [$personalDataTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDataTodolists.edit', [$personalDataTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>