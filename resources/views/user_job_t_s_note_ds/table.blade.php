<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSNoteDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSNoteDs as $userJobTSNoteD)
          
        <tr>
              
          <td>{!! $userJobTSNoteD->datetime !!}</td>
          <td>{!! $userJobTSNoteD->user_id !!}</td>
          <td>{!! $userJobTSNoteD->user_j_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSNoteDs.show', [$userJobTSNoteD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>