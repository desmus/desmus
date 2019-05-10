<div class="table-responsive">

  <table class="table table-responsive" id="collegeTSToolViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolViews as $collegeTSToolView)
          
        <tr>
              
          <td>{!! $collegeTSToolView->datetime !!}</td>
          <td>{!! $collegeTSToolView->user_id !!}</td>
          <td>{!! $collegeTSToolView->college_t_s_tool_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSToolViews.show', [$collegeTSToolView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>