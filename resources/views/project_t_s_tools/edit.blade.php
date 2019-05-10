@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_t_s_tool_update').on('submit', function() {
      
      var project_t_s_tool_name = document.getElementById("name").value;
      var project_t_s_tool_description = document.getElementById("description").value;
      
      if(project_t_s_tool_name.length >= 100)
      {
        alert("Invalid character number for the tool name.");
        return false;
      }
      
      if(project_t_s_tool_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(project_t_s_tool_name == '' || project_t_s_tool_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_t_s_tool_name != '' && project_t_s_tool_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTSTool->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                  
          {!! Form::model($projectTSTool, ['route' => ['projectTSTools.update', $projectTSTool->id], 'method' => 'patch', 'id' => 'project_t_s_tool_update']) !!}

            @include('project_t_s_tools.fields')

          {!! Form::close() !!}
               
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
        
        <a href="#user_project_tools" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Tool Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSToolFilesList as $projectTSToolFileList)
            
              <li>
                
                <a href="{!! route('projectTSToolFiles.show', [$projectTSToolFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSToolFileList -> name !!} </h4>
                    <p> {!! $projectTSToolFileList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_tool_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Tool Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSToolTodolistsList as $projectTSToolTodolistList)
            
              <li>
                
                <a href="{!! route('projectTSToolTodolists.show', [$projectTSToolTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSToolTodolistList -> name !!} </h4>
                    <p> {!! $projectTSToolTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Tool Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($projectTSToolTodolistsCompletedList as $projectTSToolTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('projectTSToolTodolists.show', [$projectTSToolTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $projectTSToolTodolistCompletedList -> name !!} </h4>
                  <p> {!! $projectTSToolTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_project_tools">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project Tool Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTSToolsList as $userProjectTSToolList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTSToolList -> name !!} </h4>
                    <p> {!! $userProjectTSToolList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="tool_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Tool Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSToolViewsList as $projectTSToolViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSToolViewList -> name !!} </h4>
                    <p> {!! $projectTSToolViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="tool_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Tool Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSToolUpdatesList as $projectTSToolUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSToolUpdateList -> name !!} </h4>
                    <p> {!! $projectTSToolUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection