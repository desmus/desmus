<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSNoteUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSNoteUs as $userJobTSNoteU)
          
        <tr>
              
          <td>{!! $userJobTSNoteU->datetime !!}</td>
          <td>{!! $userJobTSNoteU->user_id !!}</td>
          <td>{!! $userJobTSNoteU->user_j_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSNoteUs.show', [$userJobTSNoteU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>