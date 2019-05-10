<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal D T S G Id</th>
        <th colspan="3">Action</th>
         
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryCreates as $personalDataTSGaleryCreate)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryCreate->datetime !!}</td>
          <td>{!! $personalDataTSGaleryCreate->user_id !!}</td>
          <td>{!! $personalDataTSGaleryCreate->personal_d_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGaleryCreates.show', [$personalDataTSGaleryCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>