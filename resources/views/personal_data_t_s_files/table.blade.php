<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Personal Data Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSFiles as $personalDataTSFile)
          
        <tr>
              
          <td>{!! $personalDataTSFile->name !!}</td>
          <td>{!! $personalDataTSFile->description !!}</td>
          <td>{!! $personalDataTSFile->file_type !!}</td>
          <td>{!! $personalDataTSFile->views_quantity !!}</td>
          <td>{!! $personalDataTSFile->updates_quantity !!}</td>
          <td>{!! $personalDataTSFile->status !!}</td>
          <td>{!! $personalDataTSFile->personalData_topic_section_id !!}</td>
          
          <td>
                  
            {!! Form::open(['route' => ['personalDataTSFiles.destroy', $personalDataTSFile->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDataTSFiles.show', [$personalDataTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDataTSFiles.edit', [$personalDataTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>