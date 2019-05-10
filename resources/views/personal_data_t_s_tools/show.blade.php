@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_t_s_tool_todolist_create').on('submit', function() {
      
      var personal_data_t_s_tool_todolist_name = document.getElementById("name").value;
      var personal_data_t_s_tool_todolist_description = document.getElementById("description").value;
      var personal_data_t_s_tool_todolist_datetime = document.getElementById("datetime").value;
      
      if(personal_data_t_s_tool_todolist_name == '' || personal_data_t_s_tool_todolist_description == '' || personal_data_t_s_tool_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(personal_data_t_s_tool_todolist_name != '' && personal_data_t_s_tool_todolist_description != '' && personal_data_t_s_tool_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $personalDataTSTool->name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('personal_data_t_s_tools.show_fields')
          
          <a href="{!! route('personalDataTopicSections.show', [$personalDataTSTool -> personal_data_topic_section_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#files" data-toggle="tab">
        
          <i class="fa fa-file-code-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_tool_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_personal_data_tools" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#tool_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#tool_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="files">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tool Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSToolFilesList as $personalDataTSToolFileList)
            
              <li>
                
                <a href="{!! route('personalDataTSToolFiles.show', [$personalDataTSToolFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSToolFileList -> name !!} </h4>
                    <p> {!! $personalDataTSToolFileList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_tool_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tool Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSToolTodolistsList as $personalDataTSToolTodolistList)
            
              <li>
                
                <a href="{!! route('personalDataTSToolTodolists.show', [$personalDataTSToolTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSToolTodolistList -> name !!} </h4>
                    <p> {!! $personalDataTSToolTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tool Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($personalDataTSToolTodolistsCompletedList as $personalDataTSToolTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('personalDataTSToolTodolists.show', [$personalDataTSToolTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $personalDataTSToolTodolistCompletedList -> name !!} </h4>
                  <p> {!! $personalDataTSToolTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_personal_data_tools">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Tool Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTSToolsList as $userPersonalDataTSToolList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTSToolList -> name !!} </h4>
                    <p> {!! $userPersonalDataTSToolList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="tool_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tool Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSToolViewsList as $personalDataTSToolViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSToolViewList -> name !!} </h4>
                    <p> {!! $personalDataTSToolViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="tool_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tool Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSToolUpdatesList as $personalDataTSToolUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSToolUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTSToolUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection