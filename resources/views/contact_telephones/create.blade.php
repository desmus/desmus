@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#contact_telephone_create').on('submit', function() {
      
      var contact_telephone = document.getElementById("telephone").value;
      var contact_telephone_type = document.getElementById("type").value;
      
      if(contact_telephone.length >= 15 || contact_telephone.length <= 7)
      {
        alert("Invalid character number for the telephone.");
        return false;
      }
      
      if(contact_telephone_type.length >= 50)
      {
        alert("Invalid character number for the telephone type.");
        return false;
      }
      
      if(contact_telephone == '' || contact_telephone_type == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(contact_telephone != '' && contact_telephone_type != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')

  <section class="content-header">
    
    <h1> Contact Telephone </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::open(['route' => 'contactTelephones.store', 'id' => 'contact_telephone_create']) !!}
          
            @include('contact_telephones.create_fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection