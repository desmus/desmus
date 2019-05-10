@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#contact_address_create').on('submit', function() {
      
      var contact_address_street = document.getElementById("street").value;
      var contact_address_num_ext = document.getElementById("num_ext").value;
      var contact_address_num_int = document.getElementById("num_int").value;
      var contact_address_state = document.getElementById("state").value;
      var contact_address_municipality = document.getElementById("municipality").value;
      var contact_address_postal_code = document.getElementById("postal_code").value;
      var contact_address_location = document.getElementById("location").value;
      
      if(contact_address_street.length >= 100)
      {
        alert("Invalid character number for the street.");
        return false;
      }
      
      if(Number.isInteger(contact_address_num_ext))
      {
        alert("Invalid character number for the external number.");
        return false;
      }
      
      if(Number.isInteger(contact_address_num_ext))
      {
        alert("Invalid character number for the internal number.");
        return false;
      }
      
      if(contact_address_state.length >= 100)
      {
        alert("Invalid character number for the state.");
        return false;
      }
      
      if(contact_address_municipality.length >= 100)
      {
        alert("Invalid character number for the municipality.");
        return false;
      }
      
      if(contact_address_postal_code.length >= 7)
      {
        alert("Invalid character number for the postal_code.");
        return false;
      }
      
      if(contact_address_location.length >= 1000)
      {
        alert("Invalid character number for the location.");
        return false;
      }
      
      if(contact_address_street == '' || contact_address_num_ext == '' || contact_address_num_int == '' || contact_address_state == '' || contact_address_municipality == '' || contact_address_postal_code == '' || contact_address_location == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(contact_address_street != '' && contact_address_num_ext != '' && contact_address_num_int != '' && contact_address_state != '' && contact_address_municipality != '' && contact_address_postal_code != '' && contact_address_location != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
  
  <section class="content-header">
    
    <h1> Contact Address </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::open(['route' => 'contactAddresses.store', 'id' => 'contact_address_create']) !!}
          
            @include('contact_addresses.create_fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
    
    </div>
    
  </div>

@endsection