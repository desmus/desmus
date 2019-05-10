<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSNoteUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSNoteUs as $userProjectTSNoteU)
          
        <tr>
              
          <td>{!! $userProjectTSNoteU->datetime !!}</td>
          <td>{!! $userProjectTSNoteU->user_id !!}</td>
          <td>{!! $userProjectTSNoteU->user_p_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSNoteUs.show', [$userProjectTSNoteU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>