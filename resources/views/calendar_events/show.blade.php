@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#calendar_update').on('submit', function() {
      
      var event_name = document.getElementById("name").value;
      var event_description = document.getElementById("description").value;
      var event_start_date = document.getElementById("start_date").value;
      var event_start_time = document.getElementById("start_time").value;
      var event_finish_date = document.getElementById("finish_date").value;
      var event_finish_time = document.getElementById("finish_time").value;
      var event_color = document.getElementById("color").value;
      
      var date_format = /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
  
      if(event_name.length >= 100)
      {
        alert("Invalid character number for the event name.");
        return false;
      }
      
      if(event_description.length >= 1000)
      {
        alert("Invalid character number for the event description.");
        return false;
      }
  
      if(event_start_date != '')
      {
        if(date_formats = event_start_date.match(date_format))
        {
          if(date_formats[1] < 1902 || date_formats[1] > (new Date()).getFullYear())
          {
            alert("Invalid value for year: " + date_formats[3] + " - must be between 1902 and " + (new Date()).getFullYear());
            return false;
          }
          
          if(date_formats[2] < 1 || date_formats[2] > 12)
          {
            alert("Invalid value for month: " + date_formats[2]);
            return false;
          }
          
          if(date_formats[3] < 1 || date_formats[3] > 31)
          {
            alert("Invalid value for day: " + date_format[1]);
            return false;
          }
        }
        
        else
        {
          alert("Invalid date format: " + event_start_date);
          return false;
        }
      }
      
      var time_format = /^(\d{1,2}):(\d{2})([ap]m)?$/;
  
      if(event_start_time != '')
      {
        if(time_formats = event_start_time.match(time_format))
        {
          if(time_formats[1] > 23)
          {
            alert("Invalid value for hours: " + time_formats[1]);
            return false;
          }
          
          if(time_formats[2] > 59)
          {
            alert("Invalid value for minutes: " + time_formats[2]);
            return false;
          }
          
          if(time_formats[3])
          {
            if(time_formats[1] < 1 || time_formats[1] > 12)
            {
              alert("Invalid value for hours: " + time_formats[1]);
              return false;
            }
          }
        }
      
        else
        {
          alert("Invalid time format: " + event_start_time);
          return false;
        }
      }
      
      if(event_finish_date != '')
      {
        if(date_formats = event_finish_date.match(date_format))
        {
          if(date_formats[1] < 1902 || date_formats[1] > (new Date()).getFullYear())
          {
            alert("Invalid value for year: " + date_formats[3] + " - must be between 1902 and " + (new Date()).getFullYear());
            return false;
          }
          
          if(date_formats[2] < 1 || date_formats[2] > 12)
          {
            alert("Invalid value for month: " + date_formats[2]);
            return false;
          }
          
          if(date_formats[3] < 1 || date_formats[3] > 31)
          {
            alert("Invalid value for day: " + date_format[1]);
            return false;
          }
        } 
        
        else
        {
          alert("Invalid date format: " + event_finish_date);
          return false;
        }
      }
      
      var time_format = /^(\d{1,2}):(\d{2})([ap]m)?$/;
  
      if(event_finish_time != '')
      {
        if(time_formats = event_finish_time.match(time_format))
        {
          if(time_formats[1] > 23)
          {
            alert("Invalid value for hours: " + time_formats[1]);
            return false;
          }
          
          if(time_formats[2] > 59)
          {
            alert("Invalid value for minutes: " + time_formats[2]);
            return false;
          }
          
          if(time_formats[3])
          {
            if(time_formats[1] < 1 || time_formats[1] > 12)
            {
              alert("Invalid value for hours: " + time_formats[1]);
              return false;
            }
          }
        }
      
        else
        {
          alert("Invalid time format: " + event_finish_time);
          return false;
        }
      }
      
      var color_format = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i;
      
      if(event_color != '')
      {
        if(color_formats = event_color.match(color_format))
        {
          if(event_color.length != 7)
          {
            alert("Invalid value for color: " + event_color);
            return false;
          }
        } 
      
        else
        {
          alert("Invalid color format: " + event_color);
          return false;
        }
      }
      
      if(event_name == '' || event_description == '' || event_start_date == '' || event_start_time == '' || event_finish_date == '' || event_finish_time == '' || event_color == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(event_name != '' && event_description != '' && event_start_date != '' && event_start_time != '' && event_finish_date != '' && event_finish_time != '' && event_color != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>
  
@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> Calendar Event </h1>
    
  </section>
  
  <div class="content">
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          @include('calendar_events.show_fields')
          <a href="{!! route('homes.index') !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
          
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