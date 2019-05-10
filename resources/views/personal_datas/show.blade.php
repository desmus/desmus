@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_todolist_create').on('submit', function() {
      
      var personal_data_todolist_name = document.getElementById("name").value;
      var personal_data_todolist_description = document.getElementById("description").value;
      var personal_data_todolist_datetime = document.getElementById("datetime").value;
      
      if(personal_data_todolist_name == '' || personal_data_todolist_description == '' || personal_data_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(personal_data_todolist_name != '' && personal_data_todolist_description != '' && personal_data_todolist_datetime != '')
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
        
    <h1> {!! $personalData -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('personal_datas.show_fields')
                    
          <a href="{!! route('personalDatas.index') !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
          @if($user[0] -> id == $user_id)
          
            <a href="{!! route('personalDataTopics.create', [$personalData -> id]) !!}" class="btn btn-default">Add Topic</a>

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
        
        <a href="#a_personal_data_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_personal_datas" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#personal_data_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#personal_data_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Topics </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicsList as $personalDataTopicList)
            
              <li>
                
                <a href="{!! route('personalDataTopics.show', [$personalDataTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-book bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicList -> name !!} </h4>
                    <p> {!! $personalDataTopicList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_personal_data_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTodolistsList as $personalDataTodolistList)
            
              <li>
                
                <a href="{!! route('personalDataTodolists.show', [$personalDataTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTodolistList -> name !!} </h4>
                    <p> {!! $personalDataTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($personalDataTodolistsCompletedList as $personalDataTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('personalDataTodolists.show', [$personalDataTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $personalDataTodolistCompletedList -> name !!} </h4>
                  <p> {!! $personalDataTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_personal_datas">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDatasList as $userPersonalDataList)
            
              <li>
                
                <a href="{!! route('userPersonalDatas.edit', [$userPersonalDataList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataList -> name !!} </h4>
                    <p> {!! $userPersonalDataList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="personal_data_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataViewsList as $personalDataViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataViewList -> name !!} </h4>
                    <p> {!! $personalDataViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="personal_data_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataUpdatesList as $personalDataUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataUpdateList -> name !!} </h4>
                    <p> {!! $personalDataUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection