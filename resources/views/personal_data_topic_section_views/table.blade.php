<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicSectionViews-table">
      
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicSectionViews as $personalDataTopicSectionView)
          
        <tr>
              
          <td>{!! $personalDataTopicSectionView->datetime !!}</td>
          <td>{!! $personalDataTopicSectionView->user_id !!}</td>
          <td>{!! $personalDataTopicSectionView->personal_data_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTopicSectionViews.show', [$personalDataTopicSectionView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>