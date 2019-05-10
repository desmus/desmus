<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPTCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPTCreates as $collegeTSPTCreate)
          
        <tr>
              
          <td>{!! $collegeTSPTCreate->datetime !!}</td>
          <td>{!! $collegeTSPTCreate->user_id !!}</td>
          <td>{!! $collegeTSPTCreate->c_t_s_p_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPTCreates.show', [$collegeTSPTCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>