@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_tool_file_update').on('submit', function() {
      
      var college_t_s_tool_file_name = document.getElementById("name").value;
      var college_t_s_tool_file_description = document.getElementById("description").value;
      
      if(college_t_s_tool_file_name.length >= 100)
      {
        alert("Invalid character number for the file name.");
        return false;
      }
      
      if(college_t_s_tool_file_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_t_s_tool_file_name == '' || college_t_s_tool_file_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_tool_file_name != '' && college_t_s_tool_file_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTSToolFile -> name !!} </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSToolFile, ['route' => ['collegeTSToolFiles.update', $collegeTSToolFile->id], 'method' => 'patch', 'id' => 'college_t_s_tool_file_update']) !!}

            @include('college_t_s_tool_files.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_college_tool_files" data-toggle="tab">
        
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
      
      <div class="tab-pane active" id="user_college_tool_files">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Tool File Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTSToolFilesList as $userCollegeTSToolFileList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTSToolFileList -> name !!} </h4>
                    <p> {!! $userCollegeTSToolFileList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool File Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSToolFileViewsList as $collegeTSToolFileViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSToolFileViewList -> name !!} </h4>
                    <p> {!! $collegeTSToolFileViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Tool File Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSToolFileUpdatesList as $collegeTSToolFileUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSToolFileUpdateList -> name !!} </h4>
                    <p> {!! $collegeTSToolFileUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection