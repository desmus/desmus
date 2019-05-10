<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryImageCreates-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryImageCreates as $collegeTSGaleryImageCreate)
          
        <tr>
              
          <td>{!! $collegeTSGaleryImageCreate->datetime !!}</td>
          <td>{!! $collegeTSGaleryImageCreate->user_id !!}</td>
          <td>{!! $collegeTSGaleryImageCreate->college_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGaleryImageCreates.show', [$collegeTSGaleryImageCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>