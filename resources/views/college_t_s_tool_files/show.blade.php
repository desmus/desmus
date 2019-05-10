@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTSToolFile->name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('college_t_s_tool_files.show_fields')
                    
          <a href="{!! route('collegeTSTools.show', [$collegeTSToolFile -> college_t_s_t_id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
                
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