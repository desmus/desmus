<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="publicAdvertisements-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>College T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($publicAdvertisements as $publicAdvertisement)
            
        <tr>
              
          <td>{!! $publicAdvertisement->name !!}</td>
          <td>{!! $publicAdvertisement->description !!}</td>
          <td>{!! $publicAdvertisement->file_type !!}</td>
          <td>{!! $publicAdvertisement->views_quantity !!}</td>
          <td>{!! $publicAdvertisement->updates_quantity !!}</td>
          <td>{!! $publicAdvertisement->status !!}</td>
          <!--<td>{!! $publicAdvertisement->college_t_s_g_id !!}</td>-->
          
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('publicAdvertisements.show', [$publicAdvertisement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>