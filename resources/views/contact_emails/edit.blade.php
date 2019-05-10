@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#contact_email_update').on('submit', function() {
      
      var contact_email = document.getElementById("email").value;
      var contact_email_type = document.getElementById("type").value;
      
      var email_format = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      
      if(contact_email != '')
      {
        if(email_formats = contact_email.match(email_format))
        {
          if(contact_email.length >= 50)
          {
            alert("Invalid value for email: " + contact_email);
            return false;
          }
        }
      
        else
        {
          alert("Invalid email format: " + contact_email);
          return false;
        }
      }
      
      if(contact_email_type.length >= 50)
      {
        alert("Invalid character number for the email type.");
        return false;
      }
      
      if(contact_email == '' || contact_email_type == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(contact_email != '' && contact_email_type != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> Contact Email </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($contactEmail, ['route' => ['contactEmails.update', $contactEmail->id], 'method' => 'patch', 'id' => 'contact_email_update']) !!}
          
            @include('contact_emails.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection