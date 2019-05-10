<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($publicAudios as $publicAudio)
          
        <tr>
              
          <td>{!! $publicAudio->name !!}</td>
          <td>{!! $publicAudio->description !!}</td>
          <td>{!! $publicAudio->file_type !!}</td>
          <td>{!! $publicAudio->views_quantity !!}</td>
          <td>{!! $publicAudio->updates_quantity !!}</td>
          <td>{!! $publicAudio->status !!}</td>
          <!--<td>{!! $publicAudio->c_t_s_p_id !!}</td>-->
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('publicAudios.show', [$publicAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>