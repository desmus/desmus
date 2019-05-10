@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $calendarEvent[0] -> name !!} - Share List </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('user_calendar_events.show_fields')
          <a href="{!! route('calendarEvents.show', [$calendarEvent[0] -> id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class = "active">
        
        <a href="#user_calendar_events" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#calendar_event_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#calendar_event_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="user_calendar_events">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Calendar Event Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCalendarEventsList as $userCalendarEventList)
            
              <li>
                
                <a href="{!! route('userCalendarEvents.edit', [$userCalendarEventList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCalendarEventList -> name !!} </h4>
                    <p> {!! $userCalendarEventList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="calendar_event_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Calendar Event Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($calendarEventViewsList as $calendarEventViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $calendarEventViewList -> name !!} </h4>
                    <p> {!! $calendarEventViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="calendar_event_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Calendar Event Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($calendarEventUpdatesList as $calendarEventUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $calendarEventUpdateList -> name !!} </h4>
                    <p> {!! $calendarEventUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection