<table class="table table-responsive" id="collegeTSGaleryViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>College T S Galery Id</th>
      <th colspan="3">Action</th>
        
    </tr>
  
  </thead>
    
  <tbody>
    
    @foreach($collegeTSGaleryViews as $collegeTSGaleryView)
        
      <tr>
        
        <td>{!! $collegeTSGaleryView->datetime !!}</td>
        <td>{!! $collegeTSGaleryView->user_id !!}</td>
        <td>{!! $collegeTSGaleryView->college_t_s_galery_id !!}</td>
            
        <td>
          
          <div class='btn-group'>
            
            <a href="{!! route('collegeTSGaleryViews.show', [$collegeTSGaleryView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
          </div>
        
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>