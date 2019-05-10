<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P D T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPTodolists as $personalDataTSPTodolist)
          
        <tr>
              
          <td>{!! $personalDataTSPTodolist->name !!}</td>
          <td>{!! $personalDataTSPTodolist->description !!}</td>
          <td>{!! $personalDataTSPTodolist->views_quantity !!}</td>
          <td>{!! $personalDataTSPTodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTSPTodolist->status !!}</td>
          <td>{!! $personalDataTSPTodolist->datetime !!}</td>
          <td>{!! $personalDataTSPTodolist->p_d_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSPTodolists.show', [$personalDataTSPTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>