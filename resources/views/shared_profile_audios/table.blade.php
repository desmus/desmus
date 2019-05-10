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
      
      @foreach($sharedProfileAudios as $sharedProfileAudio)
          
        <tr>
              
          <td>{!! $sharedProfileAudio->name !!}</td>
          <td>{!! $sharedProfileAudio->description !!}</td>
          <td>{!! $sharedProfileAudio->file_type !!}</td>
          <td>{!! $sharedProfileAudio->views_quantity !!}</td>
          <td>{!! $sharedProfileAudio->updates_quantity !!}</td>
          <td>{!! $sharedProfileAudio->status !!}</td>
          <!--<td>{!! $sharedProfileAudio->c_t_s_p_id !!}</td>-->
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>