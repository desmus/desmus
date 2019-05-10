@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_topic_create').on('submit', function() {
      
      var project_topic_name = document.getElementById("name").value;
      
      if(project_topic_name.length >= 100)
      {
        alert("Invalid character number for the topic name.");
        return false;
      }
      
      if(project_topic_name == '')
      {
        alert("You need to assign a name for the topic.");
        return false;
      }
      
      if(project_topic_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'projectTopics.store', 'id' => 'project_topic_create']) !!}

            @include('project_topics.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#topics" data-toggle="tab">
        
          <i class="fa fa-book"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Topics </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicsList as $projectTopicList)
            
              <li>
                
                <a href="{!! route('projectTopics.show', [$projectTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-book bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicList -> name !!} </h4>
                    <p> {!! $projectTopicList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection