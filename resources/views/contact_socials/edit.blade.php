@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#contact_social_update').on('submit', function() {
      
      var contact_social_link = document.getElementById("link").value;
      var link_format = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
      
      if(contact_social_link != '')
      {
        if(link_formats = contact_social_link.match(link_format))
        {
          if(contact_social_link.length >= 50)
          {
            alert("Invalid value for the url: " + contact_social_link);
            return false;
          }
        }
      
        else
        {
          alert("Invalid url format: " + contact_social_link);
          return false;
        }
      }
      
      if(contact_social_link == '')
      {
        alert("You need to complete the field.");
        return false;
      }
      
      if(contact_social_link != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> Contact Social </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($contactSocial, ['route' => ['contactSocials.update', $contactSocial->id], 'method' => 'patch', 'id' => 'contact_social_update']) !!}
          
            @include('contact_socials.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection