@extends('layouts.app')

@section('scripts')

  <script type="text/javascript">
  
    $('#userSearch').on('keyup',function(){
   
      $value=$(this).val();
   
      $.ajax({
   
        type : 'get',
        url : '{{URL::to('UserSearch')}}',
        data:{'search':$value},
   
        success:function(data){
          $('tbody#t_user_search').html(data);
        }
   
      });
  
    })
   
  </script>

  <script>
    
    $('#contact_create').on('submit', function() {
      
      var contact_business = document.getElementById("business").value;
      var contact_job = document.getElementById("job").value;
      var contact_country = document.getElementById("country").value;
      var contact_birthdate = document.getElementById("birthdate").value;
      var contact_user_search = document.getElementById("userSearch").value;
      
      var date_format = /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
  
      if(contact_birthdate != '')
      {
        if(date_formats = contact_birthdate.match(date_format))
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
          alert("Invalid date format: " + contact_birthdate);
          return false;
        }
      }
      
      if(contact_business == '' || contact_job == '' || contact_country == '' || contact_birthdate == '' || contact_user_search == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(contact_business != '' && contact_job != '' && contact_country != '' && contact_birthdate != '' && contact_user_search != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Contact </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'contacts.store', 'id' => 'contact_create']) !!}

            @include('contacts.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class = "active">
      
        <a href="#control-sidebar-settings-tab" data-toggle="tab">
          
          <i class="fa fa-user"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">

      <div class="tab-pane active" id="control-sidebar-settings-tab">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contacts </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contacts_list as $contact_list)
            
              <li>
                
                <a href="{!! route('contacts.show', [$contact_list -> id]) !!}">
                  
                  <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $contact_list -> contact_id !!}.{!! $contact_list -> image_type !!}" alt="Alt Text">
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contact_list -> name !!} </h4>
                    <p style="font-size: 9px;"> {!! $contact_list -> email !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
            
        </ul>
        
      </div>
      
    </div>
    
  </aside>

@endsection