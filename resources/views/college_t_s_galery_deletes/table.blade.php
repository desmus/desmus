<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryDeletes-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Galery Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryDeletes as $collegeTSGaleryDelete)
          
        <tr>
              
          <td>{!! $collegeTSGaleryDelete->datetime !!}</td>
          <td>{!! $collegeTSGaleryDelete->user_id !!}</td>
          <td>{!! $collegeTSGaleryDelete->college_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGaleryDeletes.show', [$collegeTSGaleryDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>