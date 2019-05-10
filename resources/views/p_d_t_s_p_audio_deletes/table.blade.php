<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="pDTSPAudioDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($pDTSPAudioDeletes as $pDTSPAudioDelete)
          
        <tr>
              
          <td>{!! $pDTSPAudioDelete->datetime !!}</td>
          <td>{!! $pDTSPAudioDelete->user_id !!}</td>
          <td>{!! $pDTSPAudioDelete->p_d_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('pDTSPAudioDeletes.show', [$pDTSPAudioDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>