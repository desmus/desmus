@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_create').on('submit', function() {
      
      var job_name = document.getElementById("name").value;
      
      if(job_name.length >= 100)
      {
        alert("Invalid character number for the job name.");
        return false;
      }
      
      if(job_name == '')
      {
        alert("You need to assign a name for the job.");
        return false;
      }
      
      if(job_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Job </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'jobs.store', 'id' => 'job_create']) !!}

            @include('jobs.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#jobs" data-toggle="tab">
        
          <i class="fa fa-graduation-cap"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="jobs">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Jobs </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobs_list as $job_list)
            
              <li>
                
                <a href="{!! route('jobs.show', [$job_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-graduation-cap bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $job_list -> name !!} </h4>
                    <p> {!! $job_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection