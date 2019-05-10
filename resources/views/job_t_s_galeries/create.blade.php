@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_galery_create').on('submit', function() {
      
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
        
    <h1> Job Topic Section Galery </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'jobTSGaleries.store', 'id' => 'job_t_s_galery_create']) !!}

            @include('job_t_s_galeries.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#galeries" data-toggle="tab">
        
          <i class="fa fa-paint-brush"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Galeries </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGaleriesList as $jobTSGaleryList)
            
              <li>
                
                <a href="{!! route('jobTSGaleries.show', [$jobTSGaleryList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryList -> name !!} </h4>
                    <p> {!! $jobTSGaleryList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection