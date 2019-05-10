<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTFTodolists-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P D T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTFTodolists as $personalDataTSTFTodolist)
          
        <tr>
              
          <td>{!! $personalDataTSTFTodolist->name !!}</td>
          <td>{!! $personalDataTSTFTodolist->description !!}</td>
          <td>{!! $personalDataTSTFTodolist->views_quantity !!}</td>
          <td>{!! $personalDataTSTFTodolist->updates_quantity !!}</td>
          <td>{!! $personalDataTSTFTodolist->status !!}</td>
          <td>{!! $personalDataTSTFTodolist->datetime !!}</td>
          <td>{!! $personalDataTSTFTodolist->p_d_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTFTodolists.show', [$personalDataTSTFTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>