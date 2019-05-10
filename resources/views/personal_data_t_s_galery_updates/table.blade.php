<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryUpdates as $personalDataTSGaleryUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSGaleryUpdate->past_name !!}</td>
          <td>{!! $personalDataTSGaleryUpdate->datetime !!}</td>
          <td>{!! $personalDataTSGaleryUpdate->user_id !!}</td>
          <td>{!! $personalDataTSGaleryUpdate->p_d_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSGaleryUpdates.show', [$personalDataTSGaleryUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>