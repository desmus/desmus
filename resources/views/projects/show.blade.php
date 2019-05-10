@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_todolist_create').on('submit', function() {
      
      var project_todolist_name = document.getElementById("name").value;
      var project_todolist_description = document.getElementById("description").value;
      var project_todolist_datetime = document.getElementById("datetime").value;
      
      if(project_todolist_name == '' || project_todolist_description == '' || project_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_todolist_name != '' && project_todolist_description != '' && project_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

  <script>

    DecoupledEditor
            
      .create(document.querySelector('#editor'))
            
      .then( editor => {
                
        const toolbarContainer = document.querySelector('#toolbar-container');
        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            
      })
            
      .catch( error => {
                
        console.error(error);
        
      });

  </script>

  <script>

    var jq=jQuery.noConflict();
    
    jq(document).ready( function(){
      
      jq(document).keydown(function(event){

        var content = document.getElementById("editor").children;
        var contentCount = document.getElementById("editor").childElementCount;

        jq(document).ready(function($){

          $("#text").empty();

          var allText = "";

          for(var i = 0; i < contentCount; i++)
          {
            allText = allText + content[i].outerHTML;
          }

          var text = $('#text');

          text.val(allText);

        });
        
      });
      
      jq(document).mousedown(function(event){

        var content = document.getElementById("editor").children;
        var contentCount = document.getElementById("editor").childElementCount;

        jq(document).ready(function($){

          $("#text").empty();

          var allText = "";

          for(var i = 0; i < contentCount; i++)
          {
            allText = allText + content[i].outerHTML;
          }

          var text = $('#text');

          text.val(allText);

        });
        
      });
    
    });

  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $project -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('projects.show_fields')
                    
          <a href="{!! route('projects.index') !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
          @if($user[0] -> id == $user_id)
          
            <a href="{!! route('projectTopics.create', [$project -> id]) !!}" class="btn btn-default">Add Topic</a>
          
          @endif
                
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