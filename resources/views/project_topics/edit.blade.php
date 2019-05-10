@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_topic_update').on('submit', function() {
      
      var project_topic_name = document.getElementById("name").value;
      
      if(project_topic_name.length >= 100)
      {
        alert("Invalid character number for the topic name.");
        return false;
      }
      
      if(project_topic_name == '')
      {
        alert("You need to assign a name for the topic.");
        return false;
      }
      
      if(project_topic_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTopic->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopic, ['route' => ['projectTopics.update', $projectTopic->id], 'method' => 'patch', 'id' => 'project_topic_update']) !!}

            @include('project_topics.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
      
    </div>
      
  </div>

  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#sections" data-toggle="tab">
        
          <i class="fa fa-columns"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_project_topic_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_project_topics" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#project_topic_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#project_topic_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Sections </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicSectionsList as $projectTopicSectionList)
            
              <li>
                
                <a href="{!! route('projectTopicSections.show', [$projectTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicSectionList -> name !!} </h4>
                    <p> {!! $projectTopicSectionList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_project_topic_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Topic Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicTodolistsList as $projectTopicTodolistList)
            
              <li>
                
                <a href="{!! route('projectTopicTodolists.show', [$projectTopicTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicTodolistList -> name !!} </h4>
                    <p> {!! $projectTopicTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Topic Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($projectTopicTodolistsCompletedList as $projectTopicTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('projectTopicTodolists.show', [$projectTopicTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $projectTopicTodolistCompletedList -> name !!} </h4>
                  <p> {!! $projectTopicTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_project_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTopicsList as $userProjectTopicList)
            
              <li>
                
                <a href="{!! route('userProjectTopics.edit', [$userProjectTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTopicList -> name !!} </h4>
                    <p> {!! $userProjectTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="project_topic_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Topic Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicViewsList as $projectTopicViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicViewList -> name !!} </h4>
                    <p> {!! $projectTopicViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="project_topic_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Topic Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicUpdatesList as $projectTopicUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicUpdateList -> name !!} </h4>
                    <p> {!! $projectTopicUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection