<div class="table-responsive">

  <table class="table table-responsive" id="collegeTSPTViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPTViews as $collegeTSPTView)
          
        <tr>
              
          <td>{!! $collegeTSPTView->datetime !!}</td>
          <td>{!! $collegeTSPTView->user_id !!}</td>
          <td>{!! $collegeTSPTView->c_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPTViews.show', [$collegeTSPTView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>