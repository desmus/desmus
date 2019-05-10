@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_job_topic_update').on('submit', function() {
      
      var user_job_topic_permissions = document.getElementById("permissions").value;
      
      if(user_job_topic_permissions == '')
      {
        alert("You need to assign a type of permission.");
        return false;
      }
      
      if(user_job_topic_permissions != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!!$userJobTopic[0] -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTopic, ['route' => ['userJobTopics.update', $userJobTopic[0]->id], 'method' => 'patch', 'id' => 'user_job_topic_update']) !!}

            @include('user_job_topics.fields')

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
      
      <li>
        
        <a href="#user_job_topics" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#job_topic_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#job_topic_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Sections </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicSectionsList as $jobTopicSectionList)
            
              <li>
                
                <a href="{!! route('jobTopicSections.show', [$jobTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicSectionList -> name !!} </h4>
                    <p> {!! $jobTopicSectionList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTopicsList as $userJobTopicList)
            
              <li>
                
                <a href="{!! route('userJobTopics.edit', [$userJobTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTopicList -> name !!} </h4>
                    <p> {!! $userJobTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTopicsList as $userJobTopicList)
            
              <li>
                
                <a href="{!! route('userJobTopics.edit', [$userJobTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTopicList -> name !!} </h4>
                    <p> {!! $userJobTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="job_topic_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Topic Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicViewsList as $jobTopicViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicViewList -> name !!} </h4>
                    <p> {!! $jobTopicViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="job_topic_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Topic Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicUpdatesList as $jobTopicUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicUpdateList -> name !!} </h4>
                    <p> {!! $jobTopicUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection