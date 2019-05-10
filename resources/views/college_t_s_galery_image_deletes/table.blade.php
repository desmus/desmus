<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryImageDeletes-table">
      
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryImageDeletes as $collegeTSGaleryImageDelete)
          
        <tr>
              
          <td>{!! $collegeTSGaleryImageDelete->datetime !!}</td>
          <td>{!! $collegeTSGaleryImageDelete->user_id !!}</td>
          <td>{!! $collegeTSGaleryImageDelete->college_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSGaleryImageDeletes.show', [$collegeTSGaleryImageDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>