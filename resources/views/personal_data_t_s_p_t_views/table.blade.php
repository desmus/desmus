<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPTViews-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPTViews as $personalDataTSPTView)
          
        <tr>
              
          <td>{!! $personalDataTSPTView->datetime !!}</td>
          <td>{!! $personalDataTSPTView->user_id !!}</td>
          <td>{!! $personalDataTSPTView->p_d_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSPTViews.show', [$personalDataTSPTView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>