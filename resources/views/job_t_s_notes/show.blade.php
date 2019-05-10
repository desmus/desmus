@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_note_todolist_create').on('submit', function() {
      
      var job_t_s_note_todolist_name = document.getElementById("name").value;
      var job_t_s_note_todolist_description = document.getElementById("description").value;
      var job_t_s_note_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_t_s_note_todolist_name == '' || job_t_s_note_todolist_description == '' || job_t_s_note_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_note_todolist_name != '' && job_t_s_note_todolist_description != '' && job_t_s_note_todolist_datetime != '')
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
        
    <h1> {!! $jobTSNote->name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('job_t_s_notes.show_fields')
          <a href="{!! route('jobTopicSections.show', [$jobTSNote -> job_topic_section_id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
                
        </div>
            
      </div>
        
    </div>
  
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#a_note_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_job_notes" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#note_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#note_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="a_note_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Note Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSNoteTodolistsList as $jobTSNoteTodolistList)
            
              <li>
                
                <a href="{!! route('jobTSNoteTodolists.show', [$jobTSNoteTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSNoteTodolistList -> name !!} </h4>
                    <p> {!! $jobTSNoteTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Note Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($jobTSNoteTodolistsCompletedList as $jobTSNoteTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('jobTSNoteTodolists.show', [$jobTSNoteTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $jobTSNoteTodolistCompletedList -> name !!} </h4>
                  <p> {!! $jobTSNoteTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_notes">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Note Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTSNotesList as $userJobTSNoteList)
            
              <li>
                
                <a href="{!! route('userJobTSNotes.edit', [$userJobTSNoteList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTSNoteList -> name !!} </h4>
                    <p> {!! $userJobTSNoteList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="note_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Note Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSNoteViewsList as $jobTSNoteViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSNoteViewList -> name !!} </h4>
                    <p> {!! $jobTSNoteViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="note_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Note Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSNoteUpdatesList as $jobTSNoteUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSNoteUpdateList -> name !!} </h4>
                    <p> {!! $jobTSNoteUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection