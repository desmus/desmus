@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_create').on('submit', function() {
      
      var personal_data_name = document.getElementById("name").value;
      
      if(personal_data_name.length >= 100)
      {
        alert("Invalid character number for the personal_data name.");
        return false;
      }
      
      if(personal_data_name == '')
      {
        alert("You need to assign a name for the personal data.");
        return false;
      }
      
      if(personal_data_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDatas.store', 'id' => 'personal_data_create']) !!}

            @include('personal_datas.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#personal_datas" data-toggle="tab">
        
          <i class="fa fa-user"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="personal_datas">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Datas </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personal_datas_list as $personal_data_list)
            
              <li>
                
                <a href="{!! route('personalDatas.show', [$personal_data_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-user bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personal_data_list -> name !!} </h4>
                    <p> {!! $personal_data_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection