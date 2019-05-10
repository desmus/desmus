@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_galery_create').on('submit', function() {
      
      var college_t_s_galery_name = document.getElementById("name").value;
      var college_t_s_galery_description = document.getElementById("description").value;
      
      if(college_t_s_galery_name.length >= 100)
      {
        alert("Invalid character number for the galery name.");
        return false;
      }
      
      if(college_t_s_galery_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_t_s_galery_name == '' || college_t_s_galery_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_galery_name != '' && college_t_s_galery_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Section Galery </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'collegeTSGaleries.store', 'id' => 'college_t_s_galery_create']) !!}

            @include('college_t_s_galeries.create_fields')

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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Galeries </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSGaleriesList as $collegeTSGaleryList)
            
              <li>
                
                <a href="{!! route('collegeTSGaleries.show', [$collegeTSGaleryList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSGaleryList -> name !!} </h4>
                    <p> {!! $collegeTSGaleryList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection