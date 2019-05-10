<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="pDTSPAudioViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($pDTSPAudioViews as $pDTSPAudioView)
          
        <tr>
              
          <td>{!! $pDTSPAudioView->datetime !!}</td>
          <td>{!! $pDTSPAudioView->user_id !!}</td>
          <td>{!! $pDTSPAudioView->p_d_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('pDTSPAudioViews.show', [$pDTSPAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>