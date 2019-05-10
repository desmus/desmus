<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPAudioDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPAudioDeletes as $collegeTSPAudioDelete)
          
        <tr>
              
          <td>{!! $collegeTSPAudioDelete->datetime !!}</td>
          <td>{!! $collegeTSPAudioDelete->user_id !!}</td>
          <td>{!! $collegeTSPAudioDelete->c_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPAudioDeletes.show', [$collegeTSPAudioDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>