<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personal_datas-table" style="margin-bottom: 0;">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($personalDatas as $personalData)
          
        <tr>
              
          <td><a> <a href = "{!! route('personalDatas.show', [$personalData->id]) !!}"> {!! $personalData->name !!} </a> </td>
          <td>
                  
            {!! Form::open(['route' => ['personalDatas.destroy', $personalData->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('personalDatas.show', [$personalData->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('personalDatas.edit', [$personalData->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('userPersonalDatas.show', [$personalData->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
                
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>