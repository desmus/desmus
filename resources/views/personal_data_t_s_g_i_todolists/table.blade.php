<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGITodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P D T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($personalDataTSGITodolists as $personalDataTSGITodolist)
          
        <tr>
              
          <td>{!! $personalDataTSGITodolist->name !!}</td>
          <td>{!! $personalDataTSGITodolist->description !!}</td>
          <td>{!! $personalDataTSGITodolist->views_quantity !!}</td>
          <td>{!! $personalDataTSGITodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTSGITodolist->status !!}</td>
          <td>{!! $personalDataTSGITodolist->datetime !!}</td>
          <td>{!! $personalDataTSGITodolist->p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSGITodolists.show', [$personalDataTSGITodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>