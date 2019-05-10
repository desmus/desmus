@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_t_s_note_todolist_create').on('submit', function() {
      
      var personal_data_t_s_note_todolist_name = document.getElementById("name").value;
      var personal_data_t_s_note_todolist_description = document.getElementById("description").value;
      var personal_data_t_s_note_todolist_datetime = document.getElementById("datetime").value;
      
      if(personal_data_t_s_note_todolist_name == '' || personal_data_t_s_note_todolist_description == '' || personal_data_t_s_note_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(personal_data_t_s_note_todolist_name != '' && personal_data_t_s_note_todolist_description != '' && personal_data_t_s_note_todolist_datetime != '')
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
        
    <h1> {!! $personalDataTSNote->name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('personal_data_t_s_notes.show_fields')
          
          <a href="{!! route('personalDataTopicSections.show', [$personalDataTSNote -> personal_data_t_s_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
                
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
        
        <a href="#user_personal_data_notes" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Note Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSNoteTodolistsList as $personalDataTSNoteTodolistList)
            
              <li>
                
                <a href="{!! route('personalDataTSNoteTodolists.show', [$personalDataTSNoteTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSNoteTodolistList -> name !!} </h4>
                    <p> {!! $personalDataTSNoteTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Note Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($personalDataTSNoteTodolistsCompletedList as $personalDataTSNoteTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('personalDataTSNoteTodolists.show', [$personalDataTSNoteTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $personalDataTSNoteTodolistCompletedList -> name !!} </h4>
                  <p> {!! $personalDataTSNoteTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_personal_data_notes">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Note Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTSNotesList as $userPersonalDataTSNoteList)
            
              <li>
                
                <a href="{!! route('userPersonalDataTSNotes.edit', [$userPersonalDataTSNoteList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTSNoteList -> name !!} </h4>
                    <p> {!! $userPersonalDataTSNoteList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="note_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Note Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSNoteViewsList as $personalDataTSNoteViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSNoteViewList -> name !!} </h4>
                    <p> {!! $personalDataTSNoteViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="note_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Note Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSNoteUpdatesList as $personalDataTSNoteUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSNoteUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTSNoteUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection