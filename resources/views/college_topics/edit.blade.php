@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_topic_update').on('submit', function() {
      
      var college_topic_name = document.getElementById("name").value;
      
      if(college_topic_name.length >= 100)
      {
        alert("Invalid character number for the topic name.");
        return false;
      }
      
      if(college_topic_name == '')
      {
        alert("You need to assign a name for the topic.");
        return false;
      }
      
      if(college_topic_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTopic->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopic, ['route' => ['collegeTopics.update', $collegeTopic->id], 'method' => 'patch', 'id' => 'college_topic_update']) !!}

            @include('college_topics.fields')

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
        
        <a href="#a_college_topic_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_college_topics" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#college_topic_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#college_topic_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Sections </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicSectionsList as $collegeTopicSectionList)
            
              <li>
                
                <a href="{!! route('collegeTopicSections.show', [$collegeTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicSectionList -> name !!} </h4>
                    <p> {!! $collegeTopicSectionList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_college_topic_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Topic Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicTodolistsList as $collegeTopicTodolistList)
            
              <li>
                
                <a href="{!! route('collegeTopicTodolists.show', [$collegeTopicTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicTodolistList -> name !!} </h4>
                    <p> {!! $collegeTopicTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Topic Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($collegeTopicTodolistsCompletedList as $collegeTopicTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('collegeTopicTodolists.show', [$collegeTopicTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $collegeTopicTodolistCompletedList -> name !!} </h4>
                  <p> {!! $collegeTopicTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTopicsList as $userCollegeTopicList)
            
              <li>
                
                <a href="{!! route('userCollegeTopics.edit', [$userCollegeTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTopicList -> name !!} </h4>
                    <p> {!! $userCollegeTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTopicsList as $userCollegeTopicList)
            
              <li>
                
                <a href="{!! route('userCollegeTopics.edit', [$userCollegeTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTopicList -> name !!} </h4>
                    <p> {!! $userCollegeTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="college_topic_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Topic Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicViewsList as $collegeTopicViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicViewList -> name !!} </h4>
                    <p> {!! $collegeTopicViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="college_topic_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Topic Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicUpdatesList as $collegeTopicUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicUpdateList -> name !!} </h4>
                    <p> {!! $collegeTopicUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
  
@endsection