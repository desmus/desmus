@extends('layouts.app')

@section('scripts')

  <script type="text/javascript">

    $('#messagerSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url: '{{URL::to('MessagerSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#table_messager_search').html(data);
        }
 
      });

    })
    
  </script>
  
  <script type="text/javascript">

    $('#messagesSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url: '{{URL::to('MessagesSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#table_messages_search').html(data);
        }
 
      });

    })
    
  </script>
  
  <script>
    
    $('#update_profile_image').on('submit', function(){
      
      var profile_image_file = document.getElementById("image").value;
      var extension = profile_image_file.split('.').pop();
      
      if(profile_image_file == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(extension != 'jpg' && extension != 'jpeg' && extension != 'bmp' && extension != 'gif' && extension != 'png')
      {
        alert("The image type must be jpg, jpeg, bmp, gif or png.");
        return false;
      }
      
      if(profile_image_file != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>
  
  <script>
    
    $('#profile_info_create').on('submit', function(){
      
      var profile_info_name = document.getElementById("profile_name").value;
      var profile_info_email = document.getElementById("email").value;
      var profile_info_actual_password = document.getElementById("actual_password").value;
      var profile_info_password = document.getElementById("password").value;
      var profile_info_password_confirmation = document.getElementById("password_confirmation").value;
      
      var email_format = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      
      if(profile_info_name.length >= 50)
      {
        alert("Invalid character number for name.");
        return false;
      }
      
      if(profile_info_email != '')
      {
        if(email_formats = profile_info_email.match(email_format))
        {
          if(profile_info_email.length >= 50)
          {
            alert("Invalid value for email: " + profile_info_email);
            return false;
          }
        }
      
        else
        {
          alert("Invalid email format: " + profile_info_email);
          return false;
        }
      }
      
      if(profile_info_actual_password.length >= 30)
      {
        alert("Invalid character number for actual password.");
        return false;
      }
      
      if(profile_info_password.length >= 30)
      {
        alert("Invalid character number for password.");
        return false;
      }
      
      if(profile_info_password.length >= 30)
      {
        alert("Invalid character number for password confirmation.");
        return false;
      }
      
      if(profile_info_name == '' || profile_info_email == '' || profile_info_actual_password == '' || profile_info_password == '' || profile_info_password_confirmation == '')
      {
        console.log(profile_info_name, profile_info_email, profile_info_actual_password, profile_info_password, profile_info_password_confirmation);
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(profile_info_name != '' && profile_info_email != '' && profile_info_actual_password != '' && profile_info_password != '' && profile_info_password_confirmation != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>
  
  <script>
    
    $('#calendar_create').on('submit', function(){
      
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
        alert("Invalid character number for event name.");
        return false;
      }
      
      if(event_description.length >= 1000)
      {
        alert("Invalid character number for event description.");
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
  
  <script>
    
    $('#message_create').on('submit', function(){
      
      var message_d_user_id = document.getElementById("d_user_id").value;
      var message_subject = document.getElementById("subject").value;
      var message_content = document.getElementById("content").value;
      var message_importance = document.getElementById("importance").value;
      
      if(message_subject.length >= 100)
      {
        alert("Invalid character number for message subject.");
        return false;
      }
      
      if(message_content.length >= 1000)
      {
        alert("Invalid character number for message content.");
        return false;
      }
      
      if(message_d_user_id == '' || message_subject == '' || message_content == '' || message_importance == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(message_d_user_id != '' && message_subject != '' && message_content != '' && message_importance != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>
  
@endsection

@section('content')

  {!! Form::open(['route' => 'calendarEvents.store', 'id' => 'calendar_create']) !!}

  {{ csrf_field() }}

    <div id="add_event" class="modal fade" role="dialog">
      
      <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
          
          <div class="modal-header">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
              <span aria-hidden="true">×</span>
            
            </button>
            
            <h4 class="modal-title"> Add Calendar Event </h4>
            
          </div>
          
          <div class="modal-body">
            
            <div class = "row">
              
              <div class="form-group col-sm-12">
                
                <label for="name"> Title </label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Event Name"/>
                
              </div>
              
              <div class="form-group col-sm-12">
                
                <label for="description"> Description </label>
                <textarea id="description" class="form-control" name="description">Add a description ...</textarea>
                
              </div>
              
              <div class="form-group col-sm-6">
                
                <label for="start_date"> Start Date </label>
                <input id="start_date" class="form-control" type="text" name="start_date" placeholder="yyyy-mm-dd" readonly/>
                
              </div>
              
              <div class="form-group col-sm-6">
                
                <label for="start_time"> Start Time </label>
                <input id="start_time" class="form-control timepicker" type="time" name="start_time" placeholder="hh:mm"/>
                
              </div>
              
              <div class="form-group col-sm-6">
                
                <label for="finish_date"> End Date </label>
                <input id="finish_date" class="form-control" type="date" name="finish_date" placeholder="yyyy-mm-dd" min=""/>
                
              </div>
              
              <div class="form-group col-sm-4">
                
                <label for="finish_time"> End Time </label>
                <input id="finish_time" class="form-control" type="time" name="finish_time" placeholder="hh:mm"/>
                
              </div>
              
              <div class="form-group col-sm-2">
                
                <label for="color"> Color </label>
                <input id="color" class="form-control" type="color" name="color" placeholder="#ffffff"/>
                
              </div>
              
              <input class="form-control" type="hidden" name="views_quantity" value="0"/>
              <input class="form-control" type="hidden" name="updates_quantity" value="0"/>
              <input class="form-control" type="hidden" name="status" value="on"/>
              <input class="form-control" type="hidden" name="user_id" value="{{$user_id}}"/>
              
            </div>
            
          </div>
          
          <div class="modal-footer">
            
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
            <button type="submit" class="btn btn-primary"> Save </button>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  {!! Form::close() !!}
  
  {!! Form::open(['route' => 'messages.store', 'id' => 'message_create']) !!}

  {{ csrf_field() }}

    <div id="message" class="modal fade" role="dialog">
      
      <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
          
          <div class="modal-header">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
              <span aria-hidden="true">×</span>
            
            </button>
            
            <h4 class="modal-title"> New Message </h4>
            
          </div>
          
          <div class="modal-body">
            
            <div class = "row">
              
              <div class="form-group col-sm-12">
                
                <label for="d_user_id"> Contact </label>
                <select id="d_user_id" class="form-control" name="d_user_id">
                
                  @foreach($contacts as $contact)
                  
                    <option value = "{{$contact -> contact_id}}"> {{ $contact -> name }} </option>
                  
                  @endforeach
                  
                </select>
                
              </div>
              
              <div class="form-group col-sm-12">
                
                <label for="subject"> Subject </label>
                <input id="subject" class="form-control" type="text" name="subject" placeholder = "Write a subject ..."/>
                
              </div>
              
              <div class="form-group col-sm-12">
                
                <label for="content"> Message </label>
                <textarea id="content" class="form-control" name="content">Write a message ...</textarea>
                
              </div>
              
              <div class="form-group col-sm-12">
                
                <label for="importance"> Importance </label>
                
                <select id="importance" class="form-control" name="importance">
                  
                  <option value = "regular"> Regular </option>
                  <option value = "important"> Important </option>
                  <option value = "very_important"> Very Important </option>
                  
                </select>
                
              </div>
              
              <input class="form-control" type="hidden" name="views_quantity" value="0"/>
              <input class="form-control" type="hidden" name="status" value="false"/>
              <input class="form-control" type="hidden" name="datetime" value="{{$now}}"/>
              <input class="form-control" type="hidden" name="status" value="0"/>
              <input class="form-control" type="hidden" name="s_user_id" value="{{$user_id}}"/>
              
            </div>
            
          </div>
          
          <div class="modal-footer">
            
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send Message</button>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  {!! Form::close() !!}
  
  <div class="content">
    
    <div class="box box-primary" style="margin: 0;">
      
      <div class = "box-body">
        
        <div class = "col-md-12" style="padding: 0;">
          
          <div class="nav-tabs-custom" style="margin: 0;">
            
            <ul class="nav nav-tabs">
              
              <li><a href="#profile" data-toggle="tab"> Profile </a></li>
              <li><a href="#recent_activity" data-toggle="tab"> Recent Activity </a></li>
              <li class = "active"><a href="#calendar" data-toggle="tab"> Calendar </a></li>
              <li><a href="#messages" data-toggle="tab"> Messages </a></li>
              <li><a href="#contacts" data-toggle="tab"> Contacts </a></li>
              <!--<li><a href="#licenses" data-toggle="tab"> License </a></li>-->
              
            </ul>
            
            <div class="tab-content clearfix">
              
              <div class="clearfix"></div>
                  
                @include('flash::message')
                    
              <div class="clearfix"></div>
              
              <div class = "tab-pane" id = "profile">
                
                <div class = "row">
                  
                  <div class="col-sm-12" style="padding: 0;">
                    
                    <div class = "col-sm-6">
                      
                      <section class="content-header">
                  
                        <h1 class="pull-left">Profile Image</h1>
                                              
                      </section>
                
                      <div class="content" style = 'margin-top: 20px; padding-bottom: 0;'>
                  
                        <div class="clearfix"></div>
                          
                        <div class="clearfix"></div>
                          
                        <div class="box box-primary" style="margin-bottom: 20px;">
                            
                          <div class="box-body" style="padding-bottom: 0;">
                      
                            <img id = "profile_img" src="images/users/image_{!! $user[0] -> id!!}.{!! $user[0] -> image_type !!}">
                            
                            <form id = 'update_profile_image' action = "{!! URL::to('/users/'.$user_id) !!}" enctype = "multipart/form-data" method = "post">
            
                              {{ csrf_field() }}
                              
                              <div class="box-body">
                                
                                <div class="modal-body">
                                  
                                  <div class="form-group col-sm-12">
                                    {!! Form::label('image', 'Profile Image:') !!}
                                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              <div class="modal-footer">
                                
                                <div class="col-sm-12">
                                  
                                  {!! Form::submit('Update', ['class' => 'btn btn-primary', 'style' => 'margin-bottom: 0;']) !!}
                                
                                </div>
                              
                              </div>
                              
                            </form>
                      
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                    <div class = "col-sm-6">
                      
                      <section class="content-header">
                  
                        <h1 class="pull-left">Profile Information</h1>
                        
                      </section>
                
                      <div class="content" style = 'margin-top: 20px; padding-bottom: 0;'>
                  
                        <div class="clearfix"></div>
                          
                        <div class="clearfix"></div>
                          
                        <div class="box box-primary">
                          
                          {!! Form::model($user, ['route' => ['users.update', $user[0]->id], 'method' => 'patch', 'id' => 'profile_info_create']) !!}
                            
                            <div class="box-body">
                              
                              <div class="modal-body">
                        
                                <div class="form-group col-sm-12">
                                  {!! Form::label('name', 'Name:') !!}
                                  {!! Form::text('name', $user[0] -> name, ['class' => 'form-control', 'id' => 'profile_name']) !!}
                                </div>
                                
                                <div class="form-group col-sm-12">
                                  {!! Form::label('email', 'Email:') !!}
                                  {!! Form::text('email', $user[0] -> email, ['class' => 'form-control'], array('required' => 'required', 'id' => 'email')) !!}
                                </div>
                                
                                <div class="form-group col-sm-12">
                                  {!! Form::label('actual_password', 'Actual Password:') !!}
                                  {!! Form::password('actual_password', null, ['class' => 'form-control']) !!}
                                </div>
                                
                                <div class="form-group col-sm-12">
                                  {!! Form::label('password', 'Password:') !!}
                                  {!! Form::password('password', null, ['class' => 'form-control']) !!}
                                </div>
                                
                                <div class="form-group col-sm-12">
                                  {!! Form::label('password_confirmation', 'Password Confirmation:') !!}
                                  {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
                                </div>
                                
                              </div>
                              
                            </div>
                            
                            <div class="modal-footer">
                              
                              <div class="col-sm-12">
                                
                                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'style' => 'margin-bottom: 0;']) !!}
                                
                              </div>
                            
                            </div>
                            
                          {!! Form::close() !!}
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                </div>
                
              </div>
              
              <div class = "tab-pane active" id = "calendar">
                
                <div id = "calendar"> </div>
                
              </div>
              
              <div class = "tab-pane" id = "recent_activity">
                
                <div class="row">
                  
                  <div class="col-md-12">
                    
                    <ul class="timeline">
                      
                      <li class="time-label">
                        
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                        
                      </li>
                      
                      @foreach($recent_activities as $recent_activity)
                      
                        <li>
                          
                          @if($recent_activity -> type[0] == 'c' || ($recent_activity -> type[0] == 'u' && $recent_activity -> type[2] == 'c') && $recent_activity -> type != 'u_c_e_c')
                          
                            <i class="glyphicon glyphicon-education"></i>
                          
                          @endif
                          
                          @if($recent_activity -> type[0] == 'j' || ($recent_activity -> type[0] == 'u' && $recent_activity -> type[2] == 'j'))
                          
                            <i class="glyphicon glyphicon-briefcase"></i>
                          
                          @endif
                          
                          @if(($recent_activity -> type[0] == 'p' && $recent_activity -> type[2] != 'd' && $recent_activity -> type[2] != 'f' && $recent_activity -> type[2] != 'n' && $recent_activity -> type[2] != 'i' && $recent_activity -> type[2] != 'a' && $recent_activity -> type[2] != 'v') || $recent_activity -> type == 'p_d' || ($recent_activity -> type[0] == 'u' && $recent_activity -> type[2] == 'p'  && $recent_activity -> type != 'u_p_d_d'))
                          
                            <i class="glyphicon glyphicon-folder-open"></i>
                          
                          @endif
                          
                          @if($recent_activity -> type[0] == 'p' && $recent_activity -> type[2] == 'd' && $recent_activity -> type != 'p_d' || ($recent_activity -> type[0] == 'u' && $recent_activity -> type[2] == 'p' && $recent_activity -> type[4] == 'd' && $recent_activity -> type != 'u_p_d'))
                          
                            <i class="glyphicon glyphicon-user"></i>
                          
                          @endif
                          
                          @if($recent_activity -> type[0] == 'c' && $recent_activity -> type[2] == 'e' || $recent_activity -> type == 'u_c_e_c' || $recent_activity -> type == 'u_c_e_u' || $recent_activity -> type == 'u_c_e_d')
                          
                            <i class="glyphicon glyphicon-calendar"></i>
                          
                          @endif
                          
                          @if($recent_activity -> type == 'contact_c' || $recent_activity -> type == 'contact_u' || $recent_activity -> type == 'contact_d')
                          
                            <i class="glyphicon glyphicon-phone-alt"></i>
                          
                          @endif
                          
                          @if($recent_activity -> type == 'm_c' || $recent_activity -> type == 'm_u' || $recent_activity -> type == 'm_d')
                          
                            <i class="glyphicon glyphicon-envelope"></i>
                          
                          @endif
                          
                          @if($recent_activity -> type[0] == 'p' && ($recent_activity -> type[2] == 'f' || $recent_activity -> type[2] == 'n' || $recent_activity -> type[2] == 'i' || $recent_activity -> type[2] == 'a' || $recent_activity -> type[2] == 'v') && $recent_activity -> type != 'p_ad_c_c' && $recent_activity -> type != 'p_ad_c_r_c' && $recent_activity -> type != 'p_ad_l_c')
                       
                            <i class="glyphicon glyphicon-globe"></i>
                          
                          @endif
                          
                          @if(isset($recent_activity -> type[6]))
                          
                            @if($recent_activity -> type[0] == 'p' && $recent_activity -> type[4] == 'c' || $recent_activity -> type[6] == 'r' && ($recent_activity -> type[2] == 'f' || $recent_activity -> type[2] == 'n' || $recent_activity -> type[2] == 'i' || $recent_activity -> type[2] == 'a' || $recent_activity -> type[2] == 'v') || $recent_activity -> type == 'p_ad_c_c' || $recent_activity -> type == 'p_ad_c_r_c')
                            
                              <i class="glyphicon glyphicon-comment"></i>
                            
                            @endif
                            
                            @if($recent_activity -> type[0] == 'p' && $recent_activity -> type[4] == 'l' && ($recent_activity -> type[2] == 'f' || $recent_activity -> type[2] == 'n' || $recent_activity -> type[2] == 'i' || $recent_activity -> type[2] == 'a' || $recent_activity -> type[2] == 'v') || $recent_activity -> type == 'p_ad_l_c')
                            
                              <i class="glyphicon glyphicon-thumbs-up"></i>
                            
                            @endif
                          
                          @endif
                          
                          <div class="timeline-item">
                            
                            <span class="time">{!! $recent_activity -> created_at !!}</span>
                            <h3 class="timeline-header">
                              
                              @if(substr($recent_activity -> type, -1) == 'c' && $recent_activity -> type[0] != 'u')
                                
                                {!! $recent_activity -> username !!} has created
                                
                              @endif
                              
                              @if(substr($recent_activity -> type, -1) == 'u' && $recent_activity -> type[0] != 'u')
                                
                                {!! $recent_activity -> username !!} has updated
                                
                              @endif
                              
                              @if(substr($recent_activity -> type, -1) == 'd' && $recent_activity -> type[0] != 'u')
                                
                                {!! $recent_activity -> username !!} has deleted
                                
                              @endif
                              
                              @if(substr($recent_activity -> type, -1) == 'c' && $recent_activity -> type[0] == 'u')
                                
                                {!! $recent_activity -> username !!} has shared to {!! $recent_activity -> name !!}
                                
                              @endif
                              
                              @if(substr($recent_activity -> type, -1) == 'u' && $recent_activity -> type[0] == 'u')
                                
                                {!! $recent_activity -> username !!} has changed access to {!! $recent_activity -> name !!}
                                
                              @endif
                              
                              @if(substr($recent_activity -> type, -1) == 'd' && $recent_activity -> type[0] == 'u')
                                
                                {!! $recent_activity -> username !!} has deleted to {!! $recent_activity -> name !!}
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_c' || $recent_activity -> type == 'c_u' || $recent_activity -> type == 'c_d')
                              
                                the college <a href="{!! route('colleges.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_c' || $recent_activity -> type == 'c_t_u' || $recent_activity -> type == 'c_t_d')
                              
                                the college topic <a href="{!! route('collegeTopics.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_c' || $recent_activity -> type == 'c_t_s_u' || $recent_activity -> type == 'c_t_s_d')
                              
                                the college section <a href="{!! route('collegeTopicSections.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_f_c' || $recent_activity -> type == 'c_t_s_f_u' || $recent_activity -> type == 'c_t_s_f_d')
                              
                                the college file <a href="{!! route('collegeTSFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_n_c' || $recent_activity -> type == 'c_t_s_n_u' || $recent_activity -> type == 'c_t_s_n_d')
                              
                                the college note <a href="{!! route('collegeTSNotes.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_g_c' || $recent_activity -> type == 'c_t_s_g_u' || $recent_activity -> type == 'c_t_s_g_d')
                              
                                the college galery <a href="{!! route('collegeTSGaleries.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif

                              @if($recent_activity -> type == 'c_t_s_p_c' || $recent_activity -> type == 'c_t_s_p_u' || $recent_activity -> type == 'c_t_s_p_d')
                              
                                the college playlist <a href="{!! route('collegeTSPlaylists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_t_c' || $recent_activity -> type == 'c_t_s_t_u' || $recent_activity -> type == 'c_t_s_t_d')
                              
                                the college tool <a href="{!! route('collegeTSTools.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_g_i_c' || $recent_activity -> type == 'c_t_s_g_i_u' || $recent_activity -> type == 'c_t_s_g_i_d')
                              
                                the college image <a href="{!! route('collegeTSGaleryImages.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_p_a_c' || $recent_activity -> type == 'c_t_s_p_a_u' || $recent_activity -> type == 'c_t_s_p_a_d')
                              
                                the college audio <a href="{!! route('collegeTSPAudios.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_t_f_c' || $recent_activity -> type == 'c_t_s_t_f_u' || $recent_activity -> type == 'c_t_s_t_f_d')
                              
                                the college tool file <a href="{!! route('collegeTSToolFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_c' || $recent_activity -> type == 'u_c_u' || $recent_activity -> type == 'u_c_d')
                              
                                <a href="{!! route('userColleges.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_c' || $recent_activity -> type == 'u_c_t_u' || $recent_activity -> type == 'u_c_t_d')
                              
                                <a href="{!! route('userCollegeTopics.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_c' || $recent_activity -> type == 'u_c_t_s_u' || $recent_activity -> type == 'u_c_t_s_d')
                              
                                <a href="{!! route('userCollegeTopicSections.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_f_c' || $recent_activity -> type == 'u_c_t_s_f_u' || $recent_activity -> type == 'u_c_t_s_f_d')
                              
                                <a href="{!! route('userCollegeTSFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_n_c' || $recent_activity -> type == 'u_c_t_s_n_u' || $recent_activity -> type == 'u_c_t_s_n_d')
                              
                                <a href="{!! route('userCollegeTSNotes.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_g_c' || $recent_activity -> type == 'u_c_t_s_g_u' || $recent_activity -> type == 'u_c_t_s_g_d')
                              
                                <a href="{!! route('userCollegeTSGaleries.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_p_c' || $recent_activity -> type == 'u_c_t_s_p_u' || $recent_activity -> type == 'u_c_t_s_p_d')
                              
                                <a href="{!! route('userCollegeTSPlaylists.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_t_c' || $recent_activity -> type == 'u_c_t_s_t_u' || $recent_activity -> type == 'u_c_t_s_t_d')
                              
                                <a href="{!! route('userCollegeTSTools.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_g_i_c' || $recent_activity -> type == 'u_c_t_s_g_i_u' || $recent_activity -> type == 'u_c_t_s_g_i_d')
                              
                                <a href="{!! route('userCollegeTSGaleryImages.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_p_a_c' || $recent_activity -> type == 'u_c_t_s_p_a_u' || $recent_activity -> type == 'u_c_t_s_p_a_d')
                              
                                <a href="{!! route('userCollegeTSPAudios.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_t_s_t_f_c' || $recent_activity -> type == 'u_c_t_s_t_f_u' || $recent_activity -> type == 'u_c_t_s_t_f_d')
                              
                                <a href="{!! route('userCollegeTSToolFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_todo_c' || $recent_activity -> type == 'c_todo_u' || $recent_activity -> type == 'c_todo_d')
                              
                                a college task <a href="{!! route('collegeTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_todo_c' || $recent_activity -> type == 'c_t_todo_u' || $recent_activity -> type == 'c_t_todo_d')
                              
                                a college topic task <a href="{!! route('collegeTopicTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_todo_c' || $recent_activity -> type == 'c_t_s_todo_u' || $recent_activity -> type == 'c_t_s_todo_d')
                              
                                a college section task <a href="{!! route('collegeTopicSectionTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_f_todo_c' || $recent_activity -> type == 'c_t_s_f_todo_u' || $recent_activity -> type == 'c_t_s_f_todo_d')
                              
                                a college file task <a href="{!! route('collegeTSFileTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_n_todo_c' || $recent_activity -> type == 'c_t_s_n_todo_u' || $recent_activity -> type == 'c_t_s_n_todo_d')
                              
                                a college note task <a href="{!! route('collegeTSNoteTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_g_todo_c' || $recent_activity -> type == 'c_t_s_g_todo_u' || $recent_activity -> type == 'c_t_s_g_todo_d')
                              
                                a college galery task <a href="{!! route('collegeTSGaleryTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_p_t_c' || $recent_activity -> type == 'c_t_s_p_t_u' || $recent_activity -> type == 'c_t_s_p_t_d')
                              
                                a college playlist task <a href="{!! route('collegeTSPTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'c_t_s_t_todo_c' || $recent_activity -> type == 'c_t_s_t_todo_u' || $recent_activity -> type == 'c_t_s_t_todo_d')
                              
                                a college tool task <a href="{!! route('collegeTSToolTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_c' || $recent_activity -> type == 'j_u' || $recent_activity -> type == 'j_d')
                              
                                the job <a href="{!! route('jobs.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_c' || $recent_activity -> type == 'j_t_u' || $recent_activity -> type == 'j_t_d')
                              
                                the job topic <a href="{!! route('jobTopics.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_c' || $recent_activity -> type == 'j_t_s_u' || $recent_activity -> type == 'j_t_s_d')
                              
                                the job section <a href="{!! route('jobTopicSections.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_f_c' || $recent_activity -> type == 'j_t_s_f_u' || $recent_activity -> type == 'j_t_s_f_d')
                              
                                the job file <a href="{!! route('jobTSFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_n_c' || $recent_activity -> type == 'j_t_s_n_u' || $recent_activity -> type == 'j_t_s_n_d')
                              
                                the job note <a href="{!! route('jobTSNotes.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_g_c' || $recent_activity -> type == 'j_t_s_g_u' || $recent_activity -> type == 'j_t_s_g_d')
                              
                                the job galery <a href="{!! route('jobTSGaleries.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_p_c' || $recent_activity -> type == 'j_t_s_p_u' || $recent_activity -> type == 'j_t_s_p_d')
                              
                                the job playlist <a href="{!! route('jobTSPlaylists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_t_c' || $recent_activity -> type == 'j_t_s_t_u' || $recent_activity -> type == 'j_t_s_t_d')
                              
                                the job tool <a href="{!! route('jobTSTools.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_g_i_c' || $recent_activity -> type == 'j_t_s_g_i_u' || $recent_activity -> type == 'j_t_s_g_i_d')
                              
                                the job image <a href="{!! route('jobTSGaleryImages.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_p_a_c' || $recent_activity -> type == 'j_t_s_p_a_u' || $recent_activity -> type == 'j_t_s_p_a_d')
                              
                                the job audio <a href="{!! route('jobTSPAudios.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_t_f_c' || $recent_activity -> type == 'j_t_s_t_f_u' || $recent_activity -> type == 'j_t_s_t_f_d')
                              
                                the job tool file <a href="{!! route('jobTSToolFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_c' || $recent_activity -> type == 'u_j_u' || $recent_activity -> type == 'u_j_d')
                              
                                <a href="{!! route('userJobs.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_c' || $recent_activity -> type == 'u_j_t_u' || $recent_activity -> type == 'u_j_t_d')
                              
                                <a href="{!! route('userJobTopics.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_c' || $recent_activity -> type == 'u_j_t_s_u' || $recent_activity -> type == 'u_j_t_s_d')
                              
                                <a href="{!! route('userJobTopicSections.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_f_c' || $recent_activity -> type == 'u_j_t_s_f_u' || $recent_activity -> type == 'u_j_t_s_f_d')
                              
                                <a href="{!! route('userJobTSFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_n_c' || $recent_activity -> type == 'u_j_t_s_n_u' || $recent_activity -> type == 'u_j_t_s_n_d')
                              
                                <a href="{!! route('userJobTSNotes.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_g_c' || $recent_activity -> type == 'u_j_t_s_g_u' || $recent_activity -> type == 'u_j_t_s_g_d')
                              
                                <a href="{!! route('userJobTSGaleries.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_p_c' || $recent_activity -> type == 'u_j_t_s_p_u' || $recent_activity -> type == 'u_j_t_s_p_d')
                              
                                <a href="{!! route('userJobTSPlaylists.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_t_c' || $recent_activity -> type == 'u_j_t_s_t_u' || $recent_activity -> type == 'u_j_t_s_t_d')
                              
                                <a href="{!! route('userJobTSTools.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_g_i_c' || $recent_activity -> type == 'u_j_t_s_g_i_u' || $recent_activity -> type == 'u_j_t_s_g_i_d')
                              
                                <a href="{!! route('userJobTSGaleryImages.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_p_a_c' || $recent_activity -> type == 'u_j_t_s_p_a_u' || $recent_activity -> type == 'u_j_t_s_p_a_d')
                              
                                <a href="{!! route('userJobTSPAudios.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_j_t_s_t_f_c' || $recent_activity -> type == 'u_j_t_s_t_f_u' || $recent_activity -> type == 'u_j_t_s_t_f_d')
                              
                                <a href="{!! route('userJobTSToolFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_todo_c' || $recent_activity -> type == 'j_todo_u' || $recent_activity -> type == 'j_todo_d')
                              
                                a job task <a href="{!! route('jobTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_todo_c' || $recent_activity -> type == 'j_t_todo_u' || $recent_activity -> type == 'j_t_todo_d')
                              
                                a job topic task <a href="{!! route('jobTopicTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_todo_c' || $recent_activity -> type == 'j_t_s_todo_u' || $recent_activity -> type == 'j_t_s_todo_d')
                              
                                a job section task <a href="{!! route('jobTopicSectionTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_f_todo_c' || $recent_activity -> type == 'j_t_s_f_todo_u' || $recent_activity -> type == 'j_t_s_f_todo_d')
                              
                                a job file task <a href="{!! route('jobTSFileTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_n_todo_c' || $recent_activity -> type == 'j_t_s_n_todo_u' || $recent_activity -> type == 'j_t_s_n_todo_d')
                              
                                a job note task <a href="{!! route('jobTSNoteTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_g_todo_c' || $recent_activity -> type == 'j_t_s_g_todo_u' || $recent_activity -> type == 'j_t_s_g_todo_d')
                              
                                a job galery task <a href="{!! route('jobTSGaleryTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_p_t_c' || $recent_activity -> type == 'j_t_s_p_t_u' || $recent_activity -> type == 'j_t_s_p_t_d')
                              
                                a job playlist task <a href="{!! route('jobTSPTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'j_t_s_t_todo_c' || $recent_activity -> type == 'j_t_s_t_todo_u' || $recent_activity -> type == 'j_t_s_t_todo_d')
                              
                                a job tool task <a href="{!! route('jobTSToolTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_c' || $recent_activity -> type == 'p_u' || $recent_activity -> type == 'p_d')
                              
                                the project <a href="{!! route('projects.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_c' || $recent_activity -> type == 'p_t_u' || $recent_activity -> type == 'p_t_d')
                              
                                the project topic <a href="{!! route('projectTopics.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_c' || $recent_activity -> type == 'p_t_s_u' || $recent_activity -> type == 'p_t_s_d')
                              
                                the project section <a href="{!! route('projectTopicSections.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_f_c' || $recent_activity -> type == 'p_t_s_f_u' || $recent_activity -> type == 'p_t_s_f_d')
                              
                                the project file <a href="{!! route('projectTSFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_n_c' || $recent_activity -> type == 'p_t_s_n_u' || $recent_activity -> type == 'p_t_s_n_d')
                              
                                the project note <a href="{!! route('projectTSNotes.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_g_c' || $recent_activity -> type == 'p_t_s_g_u' || $recent_activity -> type == 'p_t_s_g_d')
                              
                                the project galery <a href="{!! route('projectTSGaleries.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_p_c' || $recent_activity -> type == 'p_t_s_p_u' || $recent_activity -> type == 'p_t_s_p_d')
                              
                                the project playlist <a href="{!! route('projectTSPlaylists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_t_c' || $recent_activity -> type == 'p_t_s_t_u' || $recent_activity -> type == 'p_t_s_t_d')
                              
                                the project tool <a href="{!! route('projectTSTools.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_g_i_c' || $recent_activity -> type == 'p_t_s_g_i_u' || $recent_activity -> type == 'p_t_s_g_i_d')
                              
                                the project image <a href="{!! route('projectTSGaleryImages.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_p_a_c' || $recent_activity -> type == 'p_t_s_p_a_u' || $recent_activity -> type == 'p_t_s_p_a_d')
                              
                                the project audio <a href="{!! route('projectTSPAudios.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_t_f_c' || $recent_activity -> type == 'p_t_s_t_f_u' || $recent_activity -> type == 'p_t_s_t_f_d')
                              
                                the project tool file <a href="{!! route('projectTSToolFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_c' || $recent_activity -> type == 'u_p_u' || $recent_activity -> type == 'u_p_d')
                              
                                <a href="{!! route('userProjects.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_c' || $recent_activity -> type == 'u_p_t_u' || $recent_activity -> type == 'u_p_t_d')
                              
                                <a href="{!! route('userProjectTopics.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_c' || $recent_activity -> type == 'u_p_t_s_u' || $recent_activity -> type == 'u_p_t_s_d')
                              
                                <a href="{!! route('userProjectTopicSections.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_f_c' || $recent_activity -> type == 'u_p_t_s_f_u' || $recent_activity -> type == 'u_p_t_s_f_d')
                              
                                <a href="{!! route('userProjectTSFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_n_c' || $recent_activity -> type == 'u_p_t_s_n_u' || $recent_activity -> type == 'u_p_t_s_n_d')
                              
                                <a href="{!! route('userProjectTSNotes.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_g_c' || $recent_activity -> type == 'u_p_t_s_g_u' || $recent_activity -> type == 'u_p_t_s_g_d')
                              
                                <a href="{!! route('userProjectTSGaleries.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_p_c' || $recent_activity -> type == 'u_p_t_s_p_u' || $recent_activity -> type == 'u_p_t_s_p_d')
                              
                                <a href="{!! route('userProjectTSPlaylists.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_t_c' || $recent_activity -> type == 'u_p_t_s_t_u' || $recent_activity -> type == 'u_p_t_s_t_d')
                              
                                <a href="{!! route('userProjectTSTools.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_g_i_c' || $recent_activity -> type == 'u_p_t_s_g_i_u' || $recent_activity -> type == 'u_p_t_s_g_i_d')
                              
                                <a href="{!! route('userProjectTSGaleryImages.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_p_a_c' || $recent_activity -> type == 'u_p_t_s_p_a_u' || $recent_activity -> type == 'u_p_t_s_p_a_d')
                              
                                <a href="{!! route('userProjectTSPAudios.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_t_s_t_f_c' || $recent_activity -> type == 'u_p_t_s_t_f_u' || $recent_activity -> type == 'u_p_t_s_t_f_d')
                              
                                <a href="{!! route('userProjectTSToolFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_todo_c' || $recent_activity -> type == 'p_todo_u' || $recent_activity -> type == 'p_todo_d')
                              
                                a project task <a href="{!! route('projectTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_todo_c' || $recent_activity -> type == 'p_t_todo_u' || $recent_activity -> type == 'p_t_todo_d')
                              
                                a project topic <a href="{!! route('projectTopicTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_todo_c' || $recent_activity -> type == 'p_t_s_todo_u' || $recent_activity -> type == 'p_t_s_todo_d')
                              
                                a project section <a href="{!! route('projectTopicSectionTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_f_todo_c' || $recent_activity -> type == 'p_t_s_f_todo_u' || $recent_activity -> type == 'p_t_s_f_todo_d')
                              
                                a project file <a href="{!! route('projectTSFileTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_n_todo_c' || $recent_activity -> type == 'p_t_s_n_todo_u' || $recent_activity -> type == 'p_t_s_n_todo_d')
                              
                                a project note <a href="{!! route('projectTSNoteTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_g_todo_c' || $recent_activity -> type == 'p_t_s_g_todo_u' || $recent_activity -> type == 'p_t_s_g_todo_d')
                              
                                a project galery <a href="{!! route('projectTSGaleryTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_p_t_c' || $recent_activity -> type == 'p_t_s_p_t_u' || $recent_activity -> type == 'p_t_s_p_t_d')
                              
                                a project playlist <a href="{!! route('projectTSPTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_t_s_t_todo_c' || $recent_activity -> type == 'p_t_s_t_todo_u' || $recent_activity -> type == 'p_t_s_t_todo_d')
                              
                                a project tool <a href="{!! route('projectTSToolTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_c' || $recent_activity -> type == 'p_d_u' || $recent_activity -> type == 'p_d_d')
                              
                                the personal data <a href="{!! route('personalDatas.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_c' || $recent_activity -> type == 'p_d_t_u' || $recent_activity -> type == 'p_d_t_d')
                              
                                the personal data topic <a href="{!! route('personalDataTopics.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_c' || $recent_activity -> type == 'p_d_t_s_u' || $recent_activity -> type == 'p_d_t_s_d')
                              
                                the personal data section <a href="{!! route('personalDataTopicSections.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_f_c' || $recent_activity -> type == 'p_d_t_s_f_u' || $recent_activity -> type == 'p_d_t_s_f_d')
                              
                                the personal data file <a href="{!! route('personalDataTSFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_n_c' || $recent_activity -> type == 'p_d_t_s_n_u' || $recent_activity -> type == 'p_d_t_s_n_d')
                              
                                the personal data note <a href="{!! route('personalDataTSNotes.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_g_c' || $recent_activity -> type == 'p_d_t_s_g_u' || $recent_activity -> type == 'p_d_t_s_g_d')
                              
                                the personal data galery <a href="{!! route('personalDataTSGaleries.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_p_c' || $recent_activity -> type == 'p_d_t_s_p_u' || $recent_activity -> type == 'p_d_t_s_p_d')
                              
                                the personal data playlist <a href="{!! route('personalDataTSPlaylists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_t_c' || $recent_activity -> type == 'p_d_t_s_t_u' || $recent_activity -> type == 'p_d_t_s_t_d')
                              
                                the personal data tool <a href="{!! route('personalDataTSTools.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_g_i_c' || $recent_activity -> type == 'p_d_t_s_g_i_u' || $recent_activity -> type == 'p_d_t_s_g_i_d')
                              
                                the personal data image <a href="{!! route('personalDataTSGaleryImages.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_p_a_c' || $recent_activity -> type == 'p_d_t_s_p_a_u' || $recent_activity -> type == 'p_d_t_s_p_a_d')
                              
                                the personal data audio <a href="{!! route('personalDataTSPAudios.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_t_f_c' || $recent_activity -> type == 'p_d_t_s_t_f_u' || $recent_activity -> type == 'p_d_t_s_t_f_d')
                              
                                the personal data tool file <a href="{!! route('personalDataTSToolFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_c' || $recent_activity -> type == 'u_p_d_u' || $recent_activity -> type == 'u_p_d_d')
                              
                                <a href="{!! route('userPersonalDatas.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_c' || $recent_activity -> type == 'u_p_d_t_u' || $recent_activity -> type == 'u_p_d_t_d')
                              
                                <a href="{!! route('userPersonalDataTopics.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_c' || $recent_activity -> type == 'u_p_d_t_s_u' || $recent_activity -> type == 'u_p_d_t_s_d')
                              
                                <a href="{!! route('userPersonalDataTopicSections.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_f_c' || $recent_activity -> type == 'u_p_d_t_s_f_u' || $recent_activity -> type == 'u_p_d_t_s_f_d')
                              
                                <a href="{!! route('userPersonalDataTSFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_n_c' || $recent_activity -> type == 'u_p_d_t_s_n_u' || $recent_activity -> type == 'u_p_d_t_s_n_d')
                              
                                <a href="{!! route('userPersonalDataTSNotes.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_g_c' || $recent_activity -> type == 'u_p_d_t_s_g_u' || $recent_activity -> type == 'u_p_d_t_s_g_d')
                              
                                <a href="{!! route('userPersonalDataTSGaleries.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_p_c' || $recent_activity -> type == 'u_p_d_t_s_p_u' || $recent_activity -> type == 'u_p_d_t_s_p_d')
                              
                                <a href="{!! route('userPersonalDataTSPs.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_t_c' || $recent_activity -> type == 'u_p_d_t_s_t_u' || $recent_activity -> type == 'u_p_d_t_s_t_d')
                              
                                <a href="{!! route('userPersonalDataTSTools.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_g_i_c' || $recent_activity -> type == 'u_p_d_t_s_g_i_u' || $recent_activity -> type == 'u_p_d_t_s_g_i_d')
                              
                                <a href="{!! route('userPersonalDataTSGaleryImages.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_p_a_c' || $recent_activity -> type == 'u_p_d_t_s_p_a_u' || $recent_activity -> type == 'u_p_d_t_s_p_a_d')
                              
                                <a href="{!! route('userPDTSPAudios.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_p_d_t_s_t_f_c' || $recent_activity -> type == 'u_p_d_t_s_t_f_u' || $recent_activity -> type == 'u_p_d_t_s_t_f_d')
                              
                                <a href="{!! route('userPersonalDataTSToolFiles.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'u_c_e_c' || $recent_activity -> type == 'u_c_e_u' || $recent_activity -> type == 'u_c_e_d')
                              
                                <a href="{!! route('userCalendarEvents.show', [$recent_activity -> entity_id]) !!}"> - Consultar </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_todo_c' || $recent_activity -> type == 'p_d_todo_u' || $recent_activity -> type == 'p_d_todo_d')
                              
                                a personal data task <a href="{!! route('personalDataTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_todo_c' || $recent_activity -> type == 'p_d_t_todo_u' || $recent_activity -> type == 'p_d_t_todo_d')
                              
                                a personal data topic task <a href="{!! route('personalDataTopicTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_todo_c' || $recent_activity -> type == 'p_d_t_s_todo_u' || $recent_activity -> type == 'p_d_t_s_todo_d')
                              
                                a personal data section task <a href="{!! route('personalDataTSTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_f_todo_c' || $recent_activity -> type == 'p_d_t_s_f_todo_u' || $recent_activity -> type == 'p_d_t_s_f_todo_d')
                              
                                a personal data file task <a href="{!! route('personalDataTSFileTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_n_todo_c' || $recent_activity -> type == 'p_d_t_s_n_todo_u' || $recent_activity -> type == 'p_d_t_s_n_todo_d')
                              
                                a personal data note task <a href="{!! route('personalDataTSNoteTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_g_todo_c' || $recent_activity -> type == 'p_d_t_s_g_todo_u' || $recent_activity -> type == 'p_d_t_s_g_todo_d')
                              
                                a personal data galery task <a href="{!! route('personalDataTSGaleryTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_p_t_c' || $recent_activity -> type == 'p_d_t_s_p_t_u' || $recent_activity -> type == 'p_d_t_s_p_t_d')
                              
                                a personal data playlist task <a href="{!! route('personalDataTSPTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_d_t_s_t_todo_c' || $recent_activity -> type == 'p_d_t_s_t_todo_u' || $recent_activity -> type == 'p_d_t_s_t_todo_d')
                              
                                a personal data tool task <a href="{!! route('personalDataTSToolTodolists.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                            
                              @if($recent_activity -> type == 'c_e_c' || $recent_activity -> type == 'c_e_u' || $recent_activity -> type == 'c_e_d')
                              
                                the calendar event <a href="{!! route('calendarEvents.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                            
                              @if($recent_activity -> type == 'contact_c' || $recent_activity -> type == 'contact_u' || $recent_activity -> type == 'contact_d')
                              
                                the contact <a href="{!! route('contacts.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'm_c' || $recent_activity -> type == 'm_d')
                              
                                a <a href="{!! route('messages.show', [$recent_activity -> entity_id]) !!}"> message </a> sended to {!! $recent_activity -> name !!}
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_f_c' || $recent_activity -> type == 'p_f_u' || $recent_activity -> type == 'p_f_d')
                              
                                the file <a href="{!! route('publicFiles.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_n_c' || $recent_activity -> type == 'p_n_u' || $recent_activity -> type == 'p_n_d')
                              
                                the note <a href="{!! route('publicNotes.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_i_c' || $recent_activity -> type == 'p_i_u' || $recent_activity -> type == 'p_i_d')
                              
                                an image <a href="{!! route('publicImages.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_a_c' || $recent_activity -> type == 'p_a_u' || $recent_activity -> type == 'p_a_d')
                              
                                an audio <a href="{!! route('publicAudios.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_v_c' || $recent_activity -> type == 'p_v_u' || $recent_activity -> type == 'p_v_d')
                              
                                a video <a href="{!! route('publicVideos.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_ad_c' || $recent_activity -> type == 'p_ad_u' || $recent_activity -> type == 'p_ad_d')
                              
                                an advertisement <a href="{!! route('publicAdvertisements.show', [$recent_activity -> entity_id]) !!}">{!! $recent_activity -> name !!}</a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_f_c_c' || $recent_activity -> type == 'p_f_c_u' || $recent_activity -> type == 'p_f_c_d')
                              
                                a file <a href="{!! route('publicFileComments.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_n_c_c' || $recent_activity -> type == 'p_n_c_u' || $recent_activity -> type == 'p_n_c_d')
                              
                                a note <a href="{!! route('publicNoteComments.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_i_c_c' || $recent_activity -> type == 'p_i_c_u' || $recent_activity -> type == 'p_i_c_d')
                              
                                an image <a href="{!! route('publicImageComments.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_a_c_c' || $recent_activity -> type == 'p_a_c_u' || $recent_activity -> type == 'p_a_c_d')
                              
                                an audio <a href="{!! route('publicAudioComments.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_v_c_c' || $recent_activity -> type == 'p_v_c_u' || $recent_activity -> type == 'p_v_c_d')
                              
                                a video <a href="{!! route('publicVideoComments.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_ad_c_c' || $recent_activity -> type == 'p_ad_c_u' || $recent_activity -> type == 'p_ad_c_d')
                              
                                an advertisement <a href="{!! route('publicAdvertisementComments.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_f_c_r_c' || $recent_activity -> type == 'p_f_c_r_u' || $recent_activity -> type == 'p_f_c_r_d')
                              
                                a file <a href="{!! route('publicFileCommentResponses.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_n_c_r_c' || $recent_activity -> type == 'p_n_c_r_u' || $recent_activity -> type == 'p_n_c_r_d')
                              
                                a note <a href="{!! route('publicNoteCommentResponses.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_i_c_r_c' || $recent_activity -> type == 'p_i_c_r_u' || $recent_activity -> type == 'p_i_c_r_d')
                              
                                an image <a href="{!! route('publicImageCommentResponses.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_a_c_r_c' || $recent_activity -> type == 'p_a_c_r_u' || $recent_activity -> type == 'p_a_c_r_d')
                              
                                an audio <a href="{!! route('publicAudioCommentResponses.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_v_c_r_c' || $recent_activity -> type == 'p_v_c_r_u' || $recent_activity -> type == 'p_v_c_r_d')
                              
                                a video <a href="{!! route('publicVideoCommentResponses.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_ad_c_r_c' || $recent_activity -> type == 'p_ad_c_r_u' || $recent_activity -> type == 'p_ad_c_r_d')
                              
                                an advertisement <a href="{!! route('publicAdvertisementCResponses.show', [$recent_activity -> entity_id]) !!}"> comment </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_f_l_c' || $recent_activity -> type == 'p_f_l_u' || $recent_activity -> type == 'p_f_l_d')
                              
                                a file <a href="{!! route('publicFileLikes.show', [$recent_activity -> entity_id]) !!}"> like </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_n_l_c' || $recent_activity -> type == 'p_n_l_u' || $recent_activity -> type == 'p_n_l_d')
                              
                                a note <a href="{!! route('publicNoteLikes.show', [$recent_activity -> entity_id]) !!}"> like </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_i_l_c' || $recent_activity -> type == 'p_i_l_u' || $recent_activity -> type == 'p_i_l_d')
                              
                                an image <a href="{!! route('publicImageLikes.show', [$recent_activity -> entity_id]) !!}"> like </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_a_l_c' || $recent_activity -> type == 'p_a_l_u' || $recent_activity -> type == 'p_a_l_d')
                              
                                an audio <a href="{!! route('publicAudioLikes.show', [$recent_activity -> entity_id]) !!}"> like </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_v_l_c' || $recent_activity -> type == 'p_v_l_u' || $recent_activity -> type == 'p_v_l_d')
                              
                                a video <a href="{!! route('publicVideoLikes.show', [$recent_activity -> entity_id]) !!}"> like </a>
                                
                              @endif
                              
                              @if($recent_activity -> type == 'p_ad_l_c' || $recent_activity -> type == 'p_ad_l_u' || $recent_activity -> type == 'p_ad_l_d')
                              
                                an advertisement <a href="{!! route('publicAdvertisementLikes.show', [$recent_activity -> entity_id]) !!}"> like </a>
                                
                              @endif
                            
                            </h3>
                            
                          </div>
                          
                        </li>
                      
                      @endforeach
                      
                      <li>
                        
                        <i class="fa fa-clock-o bg-gray"></i>
                        
                      </li>
                      
                    </ul>
                    
                    <div class="pull-right">
                                
                      1-200
                                  
                      <div class="btn-group recent-activity-btn-group">
                                    
                        @if($recent_activity_p < 1)
                        
                          <a href = "http://www.desmus.com.mx/homes?recent_activity_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://www.desmus.com.mx/homes?recent_activity_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                        @endif
                        
                        @if($recent_activity_p == 1)
                                    
                          <a href = "http://www.desmus.com.mx/homes?recent_activity_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://www.desmus.com.mx/homes?recent_activity_p={!! $recent_activity_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                        @endif
                        
                        @if($recent_activity_p > 1)
                        
                          <a href = "http://www.desmus.com.mx/homes?recent_activity_p={!! $recent_activity_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://www.desmus.com.mx/homes?recent_activity_p={!! $recent_activity_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                        @endif
                                    
                      </div>
                                
                    </div>
                    
                  </div>
                  
                </div>
                
              </div>
              
              <div class = "tab-pane" id = "contacts">
                
                <section class="content-header">
                  
                  <h1 class="pull-left" style="margin-bottom: 5px;">Contacts</h1>
                  <h1 class="pull-right"> <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contacts.create') !!}">Add New</a> </h1>
                  
                </section>
                
                <div class="content" style="padding: 10px 0; padding-bottom: 0; min-height: 100px;">
                    
                  <div class="clearfix"></div>
                  
                  <div class="clearfix"></div>
                    
                  <div class="box box-primary" style="margin-bottom: 0;">
                      
                    <div class="box-body">
                  
                      @include('contacts.table')
                      
                      <div class="mailbox-controls" style="padding: 0;">
                              
                        <div class="btn-group">
                                    
                        </div>
                                  
                        <div class="pull-right">
                                  
                          1-50
                                    
                          <div class="btn-group">
                                      
                            @if($contact_p < 1)
                            
                              <a href = "http://www.desmus.com.mx/homes?contact_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                              <a href = "http://www.desmus.com.mx/homes?contact_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                            
                            @endif
                            
                            @if($contact_p == 1)
                                        
                              <a href = "http://www.desmus.com.mx/homes?contact_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                              <a href = "http://www.desmus.com.mx/homes?contact_p={!! $contact_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
    
                            @endif
                            
                            @if($contact_p > 1)
                            
                              <a href = "http://www.desmus.com.mx/homes?contact_p={!! $contact_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                              <a href = "http://www.desmus.com.mx/homes?contact_p={!! $contact_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                              
                            @endif
                                      
                          </div>
                                  
                        </div>
                                  
                      </div>
                        
                    </div>
                      
                  </div>
                    
                </div>
                
              </div>
              
              <div class = "tab-pane" id = "messages">
                
                <div class="row">
                    
                  <div class="col-md-3">
                      
                    <a href="" class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#message">Compose</a>
                      
                    <div class="box box-solid" style="margin-bottom: 0;">
                        
                      <div class="box-header with-border">
                          
                        <h3 class="box-title">Folders</h3>
                          
                      </div>
                        
                      <div class="box-body no-padding">
                          
                        <ul class="nav nav-pills nav-stacked">
                            
                          <li class="active"><a href="#inbox" data-toggle="tab"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">{!! $count_r_messages !!}</span></a></li>
                          <li><a href="#sent" data-toggle="tab"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right">{!! $count_s_messages !!}</span></a></li>
                          
                        </ul>
                          
                      </div>
                        
                    </div>
                      
                  </div>
                  
                  <div class="tab-content clearfix">
                    
                    <div class = "tab-pane active" id = "inbox">
                      
                      <div class="col-md-9">
                          
                        <div class="box box-primary" style="margin-bottom: 0;">
                            
                          <div class="box-header with-border">
                              
                            <h3 class="box-title">Inbox</h3>
                              
                            <div class="box-tools pull-right">
                                
                              <div class="has-feedback">
                                  
                                <input id = "messagerSearch" type="text" class="form-control input-sm" name = "search" placeholder="Search Message">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                  
                              </div>
                                
                            </div>
                              
                          </div>
                            
                          <div class="box-body no-padding">
                              
                            <div class="mailbox-controls">
                              
                              <div class="btn-group">
                                  
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                  
                              </div>
                                
                              <div class="pull-right">
                                
                                1-50
                                  
                                <div class="btn-group">
                                    
                                  @if($r_message_p < 1)
                        
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                  
                                  @endif
                                  
                                  @if($r_message_p == 1)
                                              
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p={!! $r_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
          
                                  @endif
                                  
                                  @if($r_message_p > 1)
                                  
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p={!! $r_message_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p={!! $r_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                                  @endif
                                    
                                </div>
                                
                              </div>
                                
                            </div>
                              
                            <div class="table-responsive mailbox-messages">
                                
                              <table class="table table-hover table-striped">
                                  
                                <tbody id = 'table_messager_search'>
                                  
                                  @foreach($r_messages as $r_message)
                                    
                                    {!! Form::open(['route' => ['messages.destroy', $r_message->id], 'method' => 'delete']) !!}
                                    
                                      <tr>
                                        <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                        <td class="mailbox-name"><a href="{!! route('messages.show', [$r_message->id]) !!}">{{$r_message -> name}}</a></td>
                                        <td class="mailbox-subject"><b>{{$r_message -> subject}}</b></td>
                                        <td class="mailbox-attachment">{{$r_message -> content}}</td>
                                        <td class="mailbox-date">{{$r_message -> datetime}}</td>
                                      </tr>
                                      
                                    {!! Form::close() !!}
                                    
                                  @endforeach
                                    
                                </tbody>
                                
                              </table>
                                
                            </div>
                              
                          </div>
                            
                          <div class="box-footer no-padding">
                              
                            <div class="mailbox-controls">
                                
                              <div class="btn-group">
                    
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      
                              </div>
                                
                              <div class="pull-right">
                                  
                                1-50
                                  
                                <div class="btn-group">
                                    
                                  @if($r_message_p < 1)
                        
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                  
                                  @endif
                                  
                                  @if($r_message_p == 1)
                                              
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p={!! $r_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
          
                                  @endif
                                  
                                  @if($r_message_p > 1)
                                  
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p={!! $r_message_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?r_message_p={!! $r_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                                  @endif
                                    
                                </div>
                                  
                              </div>
                                
                            </div>
                              
                          </div>
                          
                        </div>
                    
                      </div>
                    
                    </div>
                      
                    <div class = "tab-pane" id = "sent">
                    
                      <div class="col-md-9">
                          
                        <div class="box box-primary" style="margin-bottom: 0;">
                            
                          <div class="box-header with-border">
                              
                            <h3 class="box-title">Sent</h3>
                              
                            <div class="box-tools pull-right">
                                
                              <div class="has-feedback">
                                
                                <input id = "messagesSearch" type="text" class="form-control input-sm" name = "search" placeholder="Search Message">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                  
                              </div>
                                
                            </div>
                              
                          </div>
                            
                          <div class="box-body no-padding">
                              
                            <div class="mailbox-controls">
                                
                              <div class="btn-group">
                                  
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                  
                              </div>
                                
                              <div class="pull-right">
                                
                                1-50
                                  
                                <div class="btn-group">
                                    
                                  @if($s_message_p < 1)
                        
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                  
                                  @endif
                                  
                                  @if($s_message_p == 1)
                                              
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p={!! $s_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
          
                                  @endif
                                  
                                  @if($s_message_p > 1)
                                  
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p={!! $s_message_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p={!! $s_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                                  @endif
                                    
                                </div>
                                
                              </div>
                                
                            </div>
                              
                            <div class="table-responsive mailbox-messages">
                                
                              <table class="table table-hover table-striped">
                                  
                                <tbody id = "table_messages_search">
                                  
                                  @foreach($s_messages as $s_message)
                                    
                                    {!! Form::open(['route' => ['messages.destroy', $s_message->id], 'method' => 'delete']) !!}
                                    
                                      <tr>
                                        
                                        <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                        <td class="mailbox-name"><a href="{!! route('messages.show', [$s_message->id]) !!}">{{$s_message -> name}}</a></td>
                                        <td class="mailbox-subject"><b>{{$s_message -> subject}}</b></td>
                                        <td class="mailbox-attachment">{{$s_message -> content}}</td>
                                        <td class="mailbox-date">{{$s_message -> datetime}}</td>
                                        <td> {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} </td>
                                      
                                      </tr>
                                      
                                    {!! Form::close() !!}
                                    
                                  @endforeach
                                    
                                </tbody>
                                
                              </table>
                                
                            </div>
                              
                          </div>
                            
                          <div class="box-footer no-padding">
                            
                            <div class="mailbox-controls">
                              
                              <div class="btn-group">
                                
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                
                              </div>
                                
                              <div class="pull-right">
                                  
                                1-50
                                  
                                <div class="btn-group">
                                    
                                  @if($s_message_p < 1)
                        
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                  
                                  @endif
                                  
                                  @if($s_message_p == 1)
                                              
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p={!! $s_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
          
                                  @endif
                                  
                                  @if($s_message_p > 1)
                                  
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p={!! $s_message_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                    <a href = "http://www.desmus.com.mx/homes?s_message_p={!! $s_message_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                                  @endif
                                    
                                </div>
                                  
                              </div>
                                
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                    
                    </div>
                    
                  </div>
                  
                </div>
                
              </div>
              
              <div class = "tab-pane" id = "licenses">
                
                <div class = "row">
                  
                  <div class="col-sm-12">
                    
                  </div>
                  
                </div>
                
              </div>
              
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </div>

  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab">
        
          <i class="fa fa-calendar"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#control-sidebar-home-tab" data-toggle="tab">
          
          <i class="fa fa-envelope"></i>
          
        </a>
        
      </li>
      
      <li>
      
        <a href="#control-sidebar-settings-tab" data-toggle="tab">
          
          <i class="fa fa-user"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane" id="control-sidebar-home-tab">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Received Messages </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($r_messages_list as $r_message_list)
            
            @if($r_message_list -> importance == 'regular')
            
              <li>
                
                <a href="{!! route('messages.show', [$r_message_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $r_message_list -> name !!} </h4>
                    <p> {!! $r_message_list -> subject !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
            @endif
            
            @if($r_message_list -> importance == 'important')
            
              <li>
                
                <a href="{!! route('messages.show', [$r_message_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-yellow"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $r_message_list -> name !!} </h4>
                    <p> {!! $r_message_list -> subject !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
            @endif
            
            @if($r_message_list -> importance == 'very_important')
            
              <li>
                
                <a href="{!! route('messages.show', [$r_message_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-red"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $r_message_list -> name !!} </h4>
                    <p> {!! $r_message_list -> subject !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
            @endif
            
          @endforeach
        
        </ul>
        
        <h3 class="control-sidebar-heading" style="border-bottom: 1px solid rgba(255,255,255,0.3);"> Sended Messages </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($s_messages_list as $s_message_list)
            
            @if($s_message_list -> importance == 'regular')
            
              <li>
                
                <a href="{!! route('messages.show', [$s_message_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $s_message_list -> name !!} </h4>
                    <p> {!! $s_message_list -> subject !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
            @endif
            
            @if($s_message_list -> importance == 'important')
            
              <li>
                
                <a href="{!! route('messages.show', [$s_message_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-yellow"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $s_message_list -> name !!} </h4>
                    <p> {!! $s_message_list -> subject !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
            @endif
            
            @if($s_message_list -> importance == 'very_important')
            
              <li>
                
                <a href="{!! route('messages.show', [$s_message_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-red"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $s_message_list -> name !!} </h4>
                    <p> {!! $s_message_list -> subject !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
            @endif
            
          @endforeach
        
        </ul>

      </div>
      
      <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Calendar Events </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($calendar_events as $calendar_event)
            
              <li>
                
                <a href="{!! route('calendarEvents.show', [$calendar_event -> id]) !!}">
                  
                  <i class="menu-icon fa fa-calendar" style="color: {!! $calendar_event -> color !!}; background: rgba(255,255,255,0.5);"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $calendar_event -> name !!} </h4>
                    <p> {!! $calendar_event -> start_date !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
            
        </ul>
        
      </div>

      <div class="tab-pane" id="control-sidebar-settings-tab">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contacts </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contacts_list as $contact_list)
            
              <li>
                
                <a href="{!! route('contacts.show', [$contact_list -> id]) !!}">
                  
                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $contact_list -> contact_id !!}.{!! $contact_list -> image_type !!}" alt="Alt Text">
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contact_list -> name !!} </h4>
                    <p style="font-size: 9px;"> {!! $contact_list -> email !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
            
        </ul>
      
      </div>
      
      <!--<div class="col-md-3" style = "position: fixed; bottom: -4px; right: 10px;">
          
        <div class="box box-primary direct-chat direct-chat-primary">
            
          <div class="box-header with-border">
              
            <h3 class="box-title">Direct Chat</h3>

            <div class="box-tools pull-right">
                
              <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              
              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
              
                <i class="fa fa-comments"></i></button>
              
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              
            </div>
            
          </div>
            
          <div class="box-body">
              
            <div class="direct-chat-messages">
                
              <div class="direct-chat-msg">
                  
                <div class="direct-chat-info clearfix">
                    
                  <span class="direct-chat-name pull-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                    
                </div>
                  
                <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">
                  
                <div class="direct-chat-text">
                  Is this template really for free? That's unbelievable!
                </div>
                  
              </div>

              <div class="direct-chat-msg right">
                  
                <div class="direct-chat-info clearfix">
                    
                  <span class="direct-chat-name pull-right">Sarah Bullock</span>
                  <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                 
                </div>
                  
                <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image">
                  
                <div class="direct-chat-text">
                  You better believe it!
                </div>
                  
              </div>
                
            </div>
              
            <div class="direct-chat-contacts">
                
              <ul class="contacts-list">
                  
                <li>
                  
                  <a href="#">
                  
                    <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

                    <div class="contacts-list-info">
                        
                      <span class="contacts-list-name">
                              
                        Count Dracula
                              
                        <small class="contacts-list-date pull-right">2/28/2015</small>
                            
                      </span>
                        
                      <span class="contacts-list-msg">How have you been? I was...</span>
                      
                    </div>
                      
                  </a>
                    
                </li>
                  
              </ul>
                
            </div>
              
          </div>
            
          <div class="box-footer">
              
            <form action="#" method="post">
              
              <div class="input-group">
              
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                
                <span class="input-group-btn">
              
                  <button type="submit" class="btn btn-primary btn-flat">Send</button>
              
                </span>
                  
              </div>
              
            </form>
            
          </div>
          
        </div>
            
      </div>-->

    </div>

  </aside>

@endsection