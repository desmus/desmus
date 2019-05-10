<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSNoteCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSNoteCs as $userJobTSNoteC)
          
        <tr>
              
          <td>{!! $userJobTSNoteC->datetime !!}</td>
          <td>{!! $userJobTSNoteC->user_id !!}</td>
          <td>{!! $userJobTSNoteC->user_j_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSNoteCs.show', [$userJobTSNoteC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>