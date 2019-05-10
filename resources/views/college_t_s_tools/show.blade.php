@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_tool_todolist_create').on('submit', function() {
      
      var college_t_s_tool_todolist_name = document.getElementById("name").value;
      var college_t_s_tool_todolist_description = document.getElementById("description").value;
      var college_t_s_tool_todolist_datetime = document.getElementById("datetime").value;
      
      if(college_t_s_tool_todolist_name == '' || college_t_s_tool_todolist_description == '' || college_t_s_tool_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_tool_todolist_name != '' && college_t_s_tool_todolist_description != '' && college_t_s_tool_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTSTool->name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('college_t_s_tools.show_fields')
          <a href="{!! route('collegeTopicSections.show', [$collegeTSTool -> college_topic_section_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
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
        
        <a href="#user_college_tools" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSToolFilesList as $collegeTSToolFileList)
            
              <li>
                
                <a href="{!! route('collegeTSToolFiles.show', [$collegeTSToolFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSToolFileList -> name !!} </h4>
                    <p> {!! $collegeTSToolFileList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_tool_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSToolTodolistsList as $collegeTSToolTodolistList)
            
              <li>
                
                <a href="{!! route('collegeTSToolTodolists.show', [$collegeTSToolTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSToolTodolistList -> name !!} </h4>
                    <p> {!! $collegeTSToolTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($collegeTSToolTodolistsCompletedList as $collegeTSToolTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('collegeTSToolTodolists.show', [$collegeTSToolTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $collegeTSToolTodolistCompletedList -> name !!} </h4>
                  <p> {!! $collegeTSToolTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_tools">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Tool Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTSToolsList as $userCollegeTSToolList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTSToolList -> name !!} </h4>
                    <p> {!! $userCollegeTSToolList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="tool_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSToolViewsList as $collegeTSToolViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSToolViewList -> name !!} </h4>
                    <p> {!! $collegeTSToolViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="tool_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSToolUpdatesList as $collegeTSToolUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSToolUpdateList -> name !!} </h4>
                    <p> {!! $collegeTSToolUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection