<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSNoteDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSNoteDs as $userProjectTSNoteD)
          
        <tr>
              
          <td>{!! $userProjectTSNoteD->datetime !!}</td>
          <td>{!! $userProjectTSNoteD->user_id !!}</td>
          <td>{!! $userProjectTSNoteD->user_p_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSNoteDs.show', [$userProjectTSNoteD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>