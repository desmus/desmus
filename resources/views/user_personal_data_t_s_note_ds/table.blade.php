<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSNoteDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSNoteDs as $userPersonalDataTSNoteD)
          
        <tr>
              
          <td>{!! $userPersonalDataTSNoteD->datetime !!}</td>
          <td>{!! $userPersonalDataTSNoteD->user_id !!}</td>
          <td>{!! $userPersonalDataTSNoteD->u_p_d_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSNoteDs.show', [$userPersonalDataTSNoteD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>