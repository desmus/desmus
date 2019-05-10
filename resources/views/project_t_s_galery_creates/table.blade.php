<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryCreates as $projectTSGaleryCreate)
          
        <tr>
              
          <td>{!! $projectTSGaleryCreate->datetime !!}</td>
          <td>{!! $projectTSGaleryCreate->user_id !!}</td>
          <td>{!! $projectTSGaleryCreate->project_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSGaleryCreates.show', [$projectTSGaleryCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>