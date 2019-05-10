<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolCreates as $personalDataTSToolCreate)
          
        <tr>
              
          <td>{!! $personalDataTSToolCreate->datetime !!}</td>
          <td>{!! $personalDataTSToolCreate->user_id !!}</td>
          <td>{!! $personalDataTSToolCreate->personal_data_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolCreates.show', [$personalDataTSToolCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>