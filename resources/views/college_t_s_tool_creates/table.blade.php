<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolCreates as $collegeTSToolCreate)
          
        <tr>
              
          <td>{!! $collegeTSToolCreate->datetime !!}</td>
          <td>{!! $collegeTSToolCreate->user_id !!}</td>
          <td>{!! $collegeTSToolCreate->college_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSToolCreates.show', [$collegeTSToolCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>