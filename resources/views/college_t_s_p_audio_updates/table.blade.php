<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPAudioUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPAudioUpdates as $collegeTSPAudioUpdate)
          
        <tr>
              
          <td>{!! $collegeTSPAudioUpdate->actual_name !!}</td>
          <td>{!! $collegeTSPAudioUpdate->past_name !!}</td>
          <td>{!! $collegeTSPAudioUpdate->datetime !!}</td>
          <td>{!! $collegeTSPAudioUpdate->user_id !!}</td>
          <td>{!! $collegeTSPAudioUpdate->c_t_s_p_a_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSPAudioUpdates.show', [$collegeTSPAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>