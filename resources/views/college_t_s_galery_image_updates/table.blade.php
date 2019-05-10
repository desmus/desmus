<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryImageUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryImageUpdates as $collegeTSGaleryImageUpdate)
          
        <tr>
              
          <td>{!! $collegeTSGaleryImageUpdate->actual_name !!}</td>
          <td>{!! $collegeTSGaleryImageUpdate->past_name !!}</td>
          <td>{!! $collegeTSGaleryImageUpdate->datetime !!}</td>
          <td>{!! $collegeTSGaleryImageUpdate->user_id !!}</td>
          <td>{!! $collegeTSGaleryImageUpdate->college_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGaleryImageUpdates.show', [$collegeTSGaleryImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>