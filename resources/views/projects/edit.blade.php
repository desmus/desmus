@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_update').on('submit', function() {
      
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
        
    <h1> {!! $project->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'patch', 'id' => 'project_update']) !!}

            @include('projects.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
      
    </div>
      
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#topics" data-toggle="tab">
        
          <i class="fa fa-book"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_project_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_projects" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#project_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#project_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Topics </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicsList as $projectTopicList)
            
              <li>
                
                <a href="{!! route('projectTopics.show', [$projectTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-book bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicList -> name !!} </h4>
                    <p> {!! $projectTopicList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_project_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTodolistsList as $projectTodolistList)
            
              <li>
                
                <a href="{!! route('projectTodolists.show', [$projectTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTodolistList -> name !!} </h4>
                    <p> {!! $projectTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($projectTodolistsCompletedList as $projectTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('projectTodolists.show', [$projectTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $projectTodolistCompletedList -> name !!} </h4>
                  <p> {!! $projectTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_projects">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectsList as $userProjectList)
            
              <li>
                
                <a href="{!! route('userProjects.edit', [$userProjectList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectList -> name !!} </h4>
                    <p> {!! $userProjectList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="project_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectViewsList as $projectViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectViewList -> name !!} </h4>
                    <p> {!! $projectViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="project_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectUpdatesList as $projectUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectUpdateList -> name !!} </h4>
                    <p> {!! $projectUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection