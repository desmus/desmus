@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_galery_update').on('submit', function() {
      
      var job_t_s_galery_name = document.getElementById("name").value;
      var job_t_s_galery_description = document.getElementById("description").value;
      
      if(job_t_s_galery_name.length >= 100)
      {
        alert("Invalid character number for the galery name.");
        return false;
      }
      
      if(job_t_s_galery_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(job_t_s_galery_name == '' || job_t_s_galery_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_galery_name != '' && job_t_s_galery_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTSGalerie->name !!} </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
      <div class="box box-primary">
   
        <div class="box-body">
          
          <div class="row">
            
            {!! Form::model($jobTSGalerie, ['route' => ['jobTSGaleries.update', $jobTSGalerie->id], 'method' => 'patch', 'id' => 'job_t_s_galery_update']) !!}
            
              @include('job_t_s_galeries.fields')
              
            {!! Form::close() !!}
            
          </div>
          
        </div>
        
      </div>
      
   </div>
   
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#images" data-toggle="tab">
        
          <i class="fa fa-file-image-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_galery_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_job_galeries" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#galery_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#galery_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="images">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Galery Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGImagesList as $jobTSGImageList)
            
              <li>
                
                <a href="{!! route('jobTSGaleryImages.show', [$jobTSGImageList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGImageList -> name !!} </h4>
                    <p> {!! $jobTSGImageList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_galery_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Galery Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGaleryTodolistsList as $jobTSGaleryTodolistList)
            
              <li>
                
                <a href="{!! route('jobTSGaleryTodolists.show', [$jobTSGaleryTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryTodolistList -> name !!} </h4>
                    <p> {!! $jobTSGaleryTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Galery Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($jobTSGaleryTodolistsCompletedList as $jobTSGaleryTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('jobTSGaleryTodolists.show', [$jobTSGaleryTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryTodolistCompletedList -> name !!} </h4>
                  <p> {!! $jobTSGaleryTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Galery Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTSGaleriesList as $userJobTSGaleryList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTSGaleryList -> name !!} </h4>
                    <p> {!! $userJobTSGaleryList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Galery Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGaleryViewsList as $jobTSGaleryViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryViewList -> name !!} </h4>
                    <p> {!! $jobTSGaleryViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Galery Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGaleryUpdatesList as $jobTSGaleryUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryUpdateList -> name !!} </h4>
                    <p> {!! $jobTSGaleryUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
   
@endsection