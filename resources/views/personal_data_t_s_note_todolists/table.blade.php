<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteTodolists-table">
      
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
      
      @foreach($personalDataTSNoteTodolists as $personalDataTSNoteTodolist)
          
        <tr>
              
          <td>{!! $personalDataTSNoteTodolist->name !!}</td>
          <td>{!! $personalDataTSNoteTodolist->description !!}</td>
          <td>{!! $personalDataTSNoteTodolist->views_quantity !!}</td>
          <td>{!! $personalDataTSNoteTodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTSNoteTodolist->status !!}</td>
          <td>{!! $personalDataTSNoteTodolist->datetime !!}</td>
          <td>{!! $personalDataTSNoteTodolist->personal_data_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['personalDataTSTodolists.destroy', $personalDataTSNoteTodolist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDataTSNoteTodolists.show', [$personalDataTSNoteTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDataTSNoteTodolists.edit', [$personalDataTSNoteTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>