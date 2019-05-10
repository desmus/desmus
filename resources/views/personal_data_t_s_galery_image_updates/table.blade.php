<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryImageUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryImageUpdates as $personalDataTSGaleryImageUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryImageUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSGaleryImageUpdate->past_name !!}</td>
          <td>{!! $personalDataTSGaleryImageUpdate->datetime !!}</td>
          <td>{!! $personalDataTSGaleryImageUpdate->user_id !!}</td>
          <td>{!! $personalDataTSGaleryImageUpdate->p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGaleryImageUpdates.show', [$personalDataTSGaleryImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>