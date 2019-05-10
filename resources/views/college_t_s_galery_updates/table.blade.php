<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryUpdates as $collegeTSGaleryUpdate)
          
        <tr>
              
          <td>{!! $collegeTSGaleryUpdate->actual_name !!}</td>
          <td>{!! $collegeTSGaleryUpdate->past_name !!}</td>
          <td>{!! $collegeTSGaleryUpdate->datetime !!}</td>
          <td>{!! $collegeTSGaleryUpdate->user_id !!}</td>
          <td>{!! $collegeTSGaleryUpdate->college_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGaleryUpdates.show', [$collegeTSGaleryUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>