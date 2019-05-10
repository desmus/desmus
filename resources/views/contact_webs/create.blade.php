@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#contact_web_create').on('submit', function() {
      
      var contact_web_link = document.getElementById("link").value;
      var link_format = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
      
      if(contact_web_link != '')
      {
        if(link_formats = contact_web_link.match(link_format))
        {
          if(contact_web_link.length >= 50)
          {
            alert("Invalid value for the url: " + contact_web_link);
            return false;
          }
        }
      
        else
        {
          alert("Invalid url format: " + contact_web_link);
          return false;
        }
      }
      
      if(contact_web_link == '')
      {
        alert("You need to complete the field.");
        return false;
      }
      
      if(contact_web_link != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')

  <section class="content-header">
    
    <h1> Contact Web </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::open(['route' => 'contactWebs.store', 'id' => 'contact_web_create']) !!}
          
            @include('contact_webs.create_fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection