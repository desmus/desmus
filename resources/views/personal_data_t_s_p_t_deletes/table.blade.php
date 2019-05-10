<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPTDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPTDeletes as $personalDataTSPTDelete)
        
        <tr>
              
          <td>{!! $personalDataTSPTDelete->datetime !!}</td>
          <td>{!! $personalDataTSPTDelete->user_id !!}</td>
          <td>{!! $personalDataTSPTDelete->p_d_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSPTDeletes.show', [$personalDataTSPTDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>