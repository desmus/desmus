<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#search_info" data-toggle="tab"> Information </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "college_info">
            
            <div class="form-group">
              {!! Form::label('search', 'Search:') !!}
              <p>{!! $generalSearch->search !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('entity_type', 'Entity Type:') !!}
              <p>{!! $generalSearch->entity_type !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('entity_id', 'Entity Id:') !!}
              <p>{!! $generalSearch->entity_id !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('user_id', 'User Id:') !!}
              <p>{!! $generalSearch->user_id !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('deleted_at', 'Deleted At:') !!}
              <p>{!! $generalSearch->deleted_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $generalSearch->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $generalSearch->updated_at !!}</p>
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</div>