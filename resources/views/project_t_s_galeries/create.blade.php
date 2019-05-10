@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_t_s_galery_create').on('submit', function() {
      
      var project_t_s_galery_name = document.getElementById("name").value;
      var project_t_s_galery_description = document.getElementById("description").value;
      
      if(project_t_s_galery_name.length >= 100)
      {
        alert("Invalid character number for the galery name.");
        return false;
      }
      
      if(project_t_s_galery_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(project_t_s_galery_name == '' || project_t_s_galery_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_t_s_galery_name != '' && project_t_s_galery_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Section Galery </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'projectTSGaleries.store', 'id' => 'project_t_s_galery_create']) !!}

            @include('project_t_s_galeries.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#galeries" data-toggle="tab">
        
          <i class="fa fa-paint-brush"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Galeries </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSGaleriesList as $projectTSGaleryList)
            
              <li>
                
                <a href="{!! route('projectTSGaleries.show', [$projectTSGaleryList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSGaleryList -> name !!} </h4>
                    <p> {!! $projectTSGaleryList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection