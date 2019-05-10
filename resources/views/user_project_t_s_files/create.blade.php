@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_project_t_s_file_create').on('submit', function() {
      
      var user_project_t_s_file_description = document.getElementById("description").value;
      var user_project_t_s_file_user_id = document.getElementById("user_id").value;
      
      if(user_project_t_s_file_description.length >= 190)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(user_project_t_s_file_description == '' || user_project_t_s_file_user_id == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_project_t_s_file_description != '' || user_project_t_s_file_user_id == '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Add User </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userProjectTSFiles.store', 'id' => 'user_project_t_s_file_create']) !!}

            @include('user_project_t_s_files.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_project_files" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#file_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#file_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="user_project_files">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project File Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTSFilesList as $userProjectTSFileList)
            
              <li>
                
                <a href="{!! route('userProjectTSFiles.edit', [$userProjectTSFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTSFileList -> name !!} </h4>
                    <p> {!! $userProjectTSFileList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project File Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSFileViewsList as $projectTSFileViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSFileViewList -> name !!} </h4>
                    <p> {!! $projectTSFileViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project File Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSFileUpdatesList as $projectTSFileUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSFileUpdateList -> name !!} </h4>
                    <p> {!! $projectTSFileUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
  
@endsection