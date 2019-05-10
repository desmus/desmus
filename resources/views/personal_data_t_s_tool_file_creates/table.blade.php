<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolFileCreates as $personalDataTSToolFileCreate)
          
        <tr>
              
          <td>{!! $personalDataTSToolFileCreate->datetime !!}</td>
          <td>{!! $personalDataTSToolFileCreate->user_id !!}</td>
          <td>{!! $personalDataTSToolFileCreate->p_d_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolFileCreates.show', [$personalDataTSToolFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>