@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_job_t_s_galery_update').on('submit', function() {
      
      var user_job_t_s_galery_permissions = document.getElementById("description").value;
      
      if(user_job_t_s_galery_permissions == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_job_t_s_galery_permissions != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!!$userJobTSGalerie[0] -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTSGalerie, ['route' => ['userJobTSGaleries.update', $userJobTSGalerie[0]->id], 'method' => 'patch', 'id' => 'user_job_t_s_galery_update']) !!}

            @include('user_job_t_s_galeries.fields')

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