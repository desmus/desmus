<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="pDTSPAudioUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($pDTSPAudioUpdates as $pDTSPAudioUpdate)
          
        <tr>
              
          <td>{!! $pDTSPAudioUpdate->actual_name !!}</td>
          <td>{!! $pDTSPAudioUpdate->past_name !!}</td>
          <td>{!! $pDTSPAudioUpdate->datetime !!}</td>
          <td>{!! $pDTSPAudioUpdate->user_id !!}</td>
          <td>{!! $pDTSPAudioUpdate->p_d_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('pDTSPAudioUpdates.show', [$pDTSPAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>