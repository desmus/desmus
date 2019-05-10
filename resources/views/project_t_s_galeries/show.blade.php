@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_t_s_galery_todolist_create').on('submit', function() {
      
      var project_t_s_galery_todolist_name = document.getElementById("name").value;
      var project_t_s_galery_todolist_description = document.getElementById("description").value;
      var project_t_s_galery_todolist_datetime = document.getElementById("datetime").value;
      
      if(project_t_s_galery_todolist_name == '' || project_t_s_galery_todolist_description == '' || project_t_s_galery_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_t_s_galery_todolist_name != '' && project_t_s_galery_todolist_description != '' && project_t_s_galery_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTSGalerie->name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('project_t_s_galeries.show_fields')
                    
          <a href="{!! route('projectTopicSections.show', [$projectTSGalerie -> project_topic_section_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#images" data-toggle="tab">
        
          <i class="fa fa-file-image-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_galery_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_project_galeries" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#galery_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#galery_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="images">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Galery Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSGImagesList as $projectTSGImageList)
            
              <li>
                
                <a href="{!! route('projectTSGaleryImages.show', [$projectTSGImageList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSGImageList -> name !!} </h4>
                    <p> {!! $projectTSGImageList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_galery_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Galery Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSGaleryTodolistsList as $projectTSGaleryTodolistList)
            
              <li>
                
                <a href="{!! route('projectTSGaleryTodolists.show', [$projectTSGaleryTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSGaleryTodolistList -> name !!} </h4>
                    <p> {!! $projectTSGaleryTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Galery Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($projectTSGaleryTodolistsCompletedList as $projectTSGaleryTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('projectTSGaleryTodolists.show', [$projectTSGaleryTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $projectTSGaleryTodolistCompletedList -> name !!} </h4>
                  <p> {!! $projectTSGaleryTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_project_galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project Galery Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTSGaleriesList as $userProjectTSGaleryList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTSGaleryList -> name !!} </h4>
                    <p> {!! $userProjectTSGaleryList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Galery Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSGaleryViewsList as $projectTSGaleryViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSGaleryViewList -> name !!} </h4>
                    <p> {!! $projectTSGaleryViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Galery Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSGaleryUpdatesList as $projectTSGaleryUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSGaleryUpdateList -> name !!} </h4>
                    <p> {!! $projectTSGaleryUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection