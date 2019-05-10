@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_create').on('submit', function() {
      
      var project_name = document.getElementById("name").value;
      
      if(project_name.length >= 100)
      {
        alert("Invalid character number for the project name.");
        return false;
      }
      
      if(project_name == '')
      {
        alert("You need to assign a name for the project.");
        return false;
      }
      
      if(project_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Project </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'projects.store', 'id' => 'project_create']) !!}

            @include('projects.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#projects" data-toggle="tab">
        
          <i class="fa fa-graduation-cap"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="projects">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Projects </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projects_list as $project_list)
            
              <li>
                
                <a href="{!! route('projects.show', [$project_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-graduation-cap bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $project_list -> name !!} </h4>
                    <p> {!! $project_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection