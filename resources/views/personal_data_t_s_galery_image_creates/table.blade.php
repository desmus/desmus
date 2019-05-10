<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryImageCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G I Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryImageCreates as $personalDataTSGaleryImageCreate)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryImageCreate->datetime !!}</td>
          <td>{!! $personalDataTSGaleryImageCreate->user_id !!}</td>
          <td>{!! $personalDataTSGaleryImageCreate->p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGaleryImageCreates.show', [$personalDataTSGaleryImageCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>