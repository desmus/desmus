@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_topic_section_create').on('submit', function() {
      
      var personal_data_topic_section_name = document.getElementById("name").value;
      
      if(personal_data_topic_section_name.length >= 100)
      {
        alert("Invalid character number for the section name.");
        return false;
      }
      
      if(personal_data_topic_section_name == '')
      {
        alert("You need to assign a name for the section.");
        return false;
      }
      
      if(personal_data_topic_section_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data Topic Section </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTopicSections.store', 'id' => 'personal_data_topic_section_create']) !!}

            @include('personal_data_topic_sections.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#sections" data-toggle="tab">
        
          <i class="fa fa-columns"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Sections </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicSectionsList as $personalDataTopicSectionList)
            
              <li>
                
                <a href="{!! route('personalDataTopicSections.show', [$personalDataTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicSectionList -> name !!} </h4>
                    <p> {!! $personalDataTopicSectionList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection