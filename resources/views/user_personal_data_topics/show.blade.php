@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $personalDataTopic[0] -> name !!} - Share List </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('user_personal_data_topics.show_fields')
          <a href="{!! route('personalDatas.show', [$personalDataTopic[0] -> personal_data_id]) !!}" class="btn btn-default">Back</a>
                
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
        
        <a href="#user_personal_data_topics" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#personal_data_topic_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#personal_data_topic_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
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
      
      <div class="tab-pane" id="user_personal_data_topics">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Topic Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTopicsList as $userPersonalDataTopicList)
            
              <li>
                
                <a href="{!! route('userPersonalDataTopics.edit', [$userPersonalDataTopicList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTopicList -> name !!} </h4>
                    <p> {!! $userPersonalDataTopicList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="personal_data_topic_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Topic Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicViewsList as $personalDataTopicViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicViewList -> name !!} </h4>
                    <p> {!! $personalDataTopicViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="personal_data_topic_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Topic Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicUpdatesList as $personalDataTopicUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTopicUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection