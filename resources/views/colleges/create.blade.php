@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_create').on('submit', function() {
      
      var college_name = document.getElementById("name").value;
      
      if(college_name.length >= 100)
      {
        alert("Invalid character number for the college name.");
        return false;
      }
      
      if(college_name == '')
      {
        alert("You need to assign a name for the college.");
        return false;
      }
      
      if(college_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> College </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'colleges.store', 'id' => 'college_create']) !!}

            @include('colleges.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#colleges" data-toggle="tab">
        
          <i class="fa fa-graduation-cap"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="colleges">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Colleges </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($colleges_list as $college_list)
            
              <li>
                
                <a href="{!! route('colleges.show', [$college_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-graduation-cap bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $college_list -> name !!} </h4>
                    <p> {!! $college_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection