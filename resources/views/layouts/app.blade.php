<!DOCTYPE html>

<html>

  <head>
    
    <meta charset="UTF-8">
    
    <title>Desmus</title>
    
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/skins/_all-skins.min.css">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Full Calendar -->
    <link rel='stylesheet' href='plugins/fullcalendar/fullcalendar.css' />
  
    <link rel="stylesheet" href="{{ URL::asset('css/galery.css') }}"
    
    @yield('css')
    
  </head>

  <body class="skin-black-light sidebar-mini">
    
    @if (!Auth::guest())
    
      <div class="wrapper">
        
        <header class="main-header">
          
          <a href="#" class="logo">
            <b>Desmus</b>
          </a>
          
          <nav class="navbar navbar-static-top" role="navigation">
            
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            
              <span class="sr-only">Toggle navigation</span>
            
            </a>
            
            <div class="navbar-custom-menu">
              
              <ul class="nav navbar-nav">
                
                <li class="dropdown user user-menu">
                  
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    
                    <img src="/images/users/image_{!! Auth::user()->id !!}.{!! Auth::user()->image_type !!}" class="user-image" alt="User Image"/>
                    <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                    
                  </a>
                  
                  <ul class="dropdown-menu">
                    
                    <li class="user-header">
                      
                      <img src="/images/users/image_{!! Auth::user()->id !!}.{!! Auth::user()->image_type !!}" class="img-circle" alt="User Image"/>
                      
                      <p>
                        
                        {!! Auth::user()->name !!}
                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                        
                      </p>
                      
                    </li>
                    
                    <li class="user-footer">
                      
                      <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      
                      <div class="pull-right">
                        
                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign out </a>
                        
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          
                          {{ csrf_field() }}
                          
                        </form>
                        
                      </div>
                      
                    </li>
                    
                  </ul>
                  
                </li>
                
                <li>
                  
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-bars"></i></a>
                  
                </li>
                
              </ul>
              
            </div>
            
          </nav>
          
        </header>
        
        @include('layouts.sidebar')
        
        <div class="content-wrapper">
          
          @yield('content')
          
        </div>
        
        <footer class="main-footer" style="max-height: 100px;text-align: center">
          
          <strong> Copyright © {!! date("Y"); !!} <a href=""> Desmus </a>.</strong> All rights reserved.
        
        </footer>
        
      </div>
      
    @else
    
      <nav class="navbar navbar-default navbar-static-top">
        
        <div class="container">
            
          <div class="navbar-header">
            
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              
            </button>
            
            <a class="navbar-brand" href="{!! url('/') !!}"> Desmus </a>
            
          </div>
          
          <div class="collapse navbar-collapse" id="app-navbar-collapse">
            
            <ul class="nav navbar-nav">
              
              <!--<li><a href="{!! url('/home') !!}">Home</a></li>-->
              
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
              
              <li><a href="{!! url('/login') !!}">Login</a></li>
              <li><a href="{!! url('/register') !!}">Register</a></li>
              
            </ul>
            
          </div>
          
        </div>
        
      </nav>
      
      <div id="page-content-wrapper">
        
        <div class="container-fluid">
          
          <div class="row">
            
            <div class="col-lg-12">
              
              @yield('content')
              
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    @endif
    
    <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-beta.2/decoupled-document/ckeditor.js"></script>
    
    <!-- Full Calendar -->
    <!--<script src='plugins/fullcalendar/lib/jquery.min.js'></script>-->
    <script src='plugins/fullcalendar/lib/moment.min.js'></script>
    <script src='plugins/fullcalendar/fullcalendar.js'></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <script type="text/javascript">
      $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
    
    <script>
    
      $(function () {
        
        $('#sidebar-form').on('submit', function (e) {
          e.preventDefault();
        });
        
        $('.sidebar-menu li.active').data('lte.pushmenu.active', true);
        
        $('#search-input').on('keyup', function () {
          
          var term = $('#search-input').val().trim();
          
          if (term.length === 0) {
            
            $('.sidebar-menu li').each(function () {
              
              $(this).show(0);
              $(this).removeClass('active');
              
              if ($(this).data('lte.pushmenu.active')) {
                $(this).addClass('active');
              }
              
            });
            
            return;
            
          }
          
          $('.sidebar-menu li').each(function () {
            
            if ($(this).text().toLowerCase().indexOf(term.toLowerCase()) === -1) {
              
              $(this).hide(0);
              $(this).removeClass('pushmenu-search-found', false);
              
              if ($(this).is('.treeview')) {
                $(this).removeClass('active');
              }
              
            }
            
            else {
              
              $(this).show(0);
              $(this).addClass('pushmenu-search-found');
              
              if ($(this).is('.treeview')) {
                $(this).addClass('active');
              }
              
              var parent = $(this).parents('li').first();
              
              if (parent.is('.treeview')) {
                parent.show(0);
              }
              
            }
            
            if ($(this).is('.header')) {
              
              $(this).show();
              
            }
            
          });
          
          $('.sidebar-menu li.pushmenu-search-found.treeview').each(function () {
            $(this).find('.pushmenu-search-found').show(0);
          });
        
        });
        
      });
    
    </script>
    
    <script>
    
      $(function() {
        
        'use strict';
        
        var calendarEvent =  [];
        
        $.ajax({
          url:'/GetCalendarEvent',
          type:"GET",
          dataType:"JSON",
          async:false
        }).done(function(r){
        
          calendarEvent = r;
        
        });
        
        $('#calendar').fullCalendar({
        
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek,listDay'
          },
          
          events: calendarEvent,
          
          dayClick: function(date, jsEvent, view, resourceObj) {
            
            $('#add_event').modal("show");
            $('#start_date').val(date.format());
            $('#finish_date').attr('min', date.format());
            
          },
          
          eventClick: function(event) {
            
            window.open('calendarEvents/'+event.id, '_self');
            return false;
            
          },
          
          editable: false,
          eventLimit: true,
          nowIndicator: true,
          eventOverlap: false
          
        });
        
      });
      
    </script>
    
    <!--eventDrop: function(event, delta, revertFunc) {
            
      alert(event.title + " was dropped on " + event.start.format());
            
      if (!confirm("Are you sure about this change?")) {
        revertFunc();
      }
              
      var start_d = String(event.start._i[0]) + "-0" + String(event.start._i[1]) + "-0" + String(event.start._i[2]);
      var start_t = String(event.start._i[3]) + ":" + String(event.start._i[4]) + ":" + String(event.start._i[5]) + "" + String(event.start._i[6]);
      var end_d = String(event.end._i[0]) + "-0" + String(event.end._i[1]) + "-0" + String(event.end._i[2]);
      var end_t = String(event.end._i[3]) + ":" + String(event.end._i[4]) + ":" + String(event.end._i[5]) + "" + String(event.end._i[6]);
            
      console.log(start_d);
      console.log(start_t);
      console.log(end_d);
      console.log(end_t);
            
      var base_url = 'http://desmus-jmsp.c9users.io';
              
      $.ajax({
        type: "POST",
        url : base_url + "/updateCalendarEvent/"+event.id,
        data : {start_date:start_d, start_time:start_t, finish_date:end_d, finish_time:end_t},
        success : function(data){
          console.log(data);
        }
            
      });
            
    }-->
    
    <script>
      
      Plotly.d3.csv('https://raw.githubusercontent.com/plotly/datasets/master/api_docs/mt_bruno_elevation.csv', function(err, rows){
      
        function unpack(rows, key) {
          return rows.map(function(row) { return row[key]; });
        }
          
        var z_data=[]
        
        for(i=0;i<24;i++)
        {
          z_data.push(unpack(rows,i));
        }
        
        var data = [{
          z: z_data,
          type: 'surface'
        }];
          
        var layout = {
          title: '',
          autosize: false,
          width: 1100,
          height: 600,
          margin: {
            l: 65,
            r: 50,
            b: 65,
            t: 90,
          }
        };
        
        Plotly.newPlot('chart', data, layout);
        
      });
      
    </script>
    
    <script>
      
      var audio = new Audio();
      var audio_type = document.getElementById('audio_type').value;
      var audio_name = document.getElementById('audio_name').value;
      
      if(audio_type == 'college')
      {
        audio.src = '/audios/colleges/audio_'+audio_name+'.mp3';
      }
      
      else if(audio_type == 'job')
      {
        audio.src = '/audios/jobs/audio_'+audio_name+'.mp3';
      }
      
      else if(audio_type == 'project')
      {
        audio.src = '/audios/projects/audio_'+audio_name+'.mp3';
      }
      
      else if(audio_type == 'personal_data')
      {
        audio.src = '/audios/personal_datas/audio_'+audio_name+'.mp3';
      }
      
      else if(audio_type == 'public_audio')
      {
        audio.src = '/audios/public_audios/audio_'+audio_name+'.mp3';
      }
      
      else if(audio_type == 'shared_profile_audio')
      {
        audio.src = '/audios/shared_profile_audios/audio_'+audio_name+'.mp3';
      }

      audio.controls = true;
      audio.loop = true;
      audio.autoplay = false;
      
      var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width, bar_height;

      window.addEventListener('load', initMp3Player, false)
      
      function initMp3Player()
      {
        document.getElementById('audio_box').appendChild(audio);
        context = new AudioContext();
        analyser = context.createAnalyser();
        canvas = document.getElementById('analyser');
        ctx = canvas.getContext('2d');
        
        source = context.createMediaElementSource(audio);
        source.connect(analyser);
        analyser.connect(context.destination);
        frameLooper();
      }
      
      function frameLooper()
      {
        window.requestAnimationFrame(frameLooper);
        fbc_array = new Uint8Array(analyser.frequencyBinCount);
        analyser.getByteFrequencyData(fbc_array);
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.fillStyle = '#00CCFF';
        bars = 100;
        
        for(var i = 0; i < bars; i++)
        {
          bar_x = i * 5;
          bar_width = 4;
          bar_height = -(fbc_array[i] / 2);
          ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);
        }
      }
      
    </script>
    
    @yield('scripts')
    
  </body>
  
</html>