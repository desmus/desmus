<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPTCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPTCreates as $personalDataTSPTCreate)
          
        <tr>
              
          <td>{!! $personalDataTSPTCreate->datetime !!}</td>
          <td>{!! $personalDataTSPTCreate->user_id !!}</td>
          <td>{!! $personalDataTSPTCreate->p_d_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSPTCreates.show', [$personalDataTSPTCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>