<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTodolists-table">
      
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
      
      @foreach($personalDataTSTodolists as $personalDataTSTodolist)
          
        <tr>
              
          <td>{!! $personalDataTSTodolist->name !!}</td>
          <td>{!! $personalDataTSTodolist->description !!}</td>
          <td>{!! $personalDataTSTodolist->views_quantity !!}</td>
          <td>{!! $personalDataTSTodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTSTodolist->status !!}</td>
          <td>{!! $personalDataTSTodolist->datetime !!}</td>
          <td>{!! $personalDataTSTodolist->personal_data_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['personalDataTSTodolists.destroy', $personalDataTSTodolist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDataTSTodolists.show', [$personalDataTSTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDataTSTodolists.edit', [$personalDataTSTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>