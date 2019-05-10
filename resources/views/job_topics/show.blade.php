@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_topic_todolist_create').on('submit', function() {
      
      var job_topic_todolist_name = document.getElementById("name").value;
      var job_topic_todolist_description = document.getElementById("description").value;
      var job_topic_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_topic_todolist_name == '' || job_topic_todolist_description == '' || job_topic_todolist_status == '' || job_topic_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_topic_todolist_name != '' && job_topic_todolist_description != '' && job_topic_todolist_status != '' && job_topic_todolist_datetime != '')
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
        
    <h1> {!! $jobTopic -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('job_topics.show_fields')
                    
          <a href="{!! route('jobs.show', [$jobTopic -> job_id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
          
          @if($user[0] -> id == $user_id)
          
            <a href="{!! route('jobTopicSections.create', [$jobTopic -> id]) !!}" class="btn btn-default">Add Section</a>
          
          @endif
                
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
        
        <a href="#a_job_topic_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_job_topics" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#job_topic_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#job_topic_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Sections </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicSectionsList as $jobTopicSectionList)
            
              <li>
                
                <a href="{!! route('jobTopicSections.show', [$jobTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicSectionList -> name !!} </h4>
                    <p> {!! $jobTopicSectionList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_job_topic_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Topic Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicTodolistsList as $jobTopicTodolistList)
            
              <li>
                
                <a href="{!! route('jobTopicTodolists.show', [$jobTopicTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicTodolistList -> name !!} </h4>
                    <p> {!! $jobTopicTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Topic Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($jobTopicTodolistsCompletedList as $jobTopicTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('jobTopicTodolists.show', [$jobTopicTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $jobTopicTodolistCompletedList -> name !!} </h4>
                  <p> {!! $jobTopicTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTopicsList as $userJobTopicList)
            
              <li>
                
                <a href="{!! route('userJobTopics.edit', [$userJobTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTopicList -> name !!} </h4>
                    <p> {!! $userJobTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTopicsList as $userJobTopicList)
            
              <li>
                
                <a href="{!! route('userJobTopics.edit', [$userJobTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTopicList -> name !!} </h4>
                    <p> {!! $userJobTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="job_topic_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Topic Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicViewsList as $jobTopicViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicViewList -> name !!} </h4>
                    <p> {!! $jobTopicViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="job_topic_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Topic Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicUpdatesList as $jobTopicUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicUpdateList -> name !!} </h4>
                    <p> {!! $jobTopicUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection