@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_shared_profile_create').on('submit', function() {
      
      var user_shared_profile_description = document.getElementById("description").value;
      var user_shared_profile_user_id = document.getElementById("user_id").value;
      
      if(user_shared_profile_description.length >= 190)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(user_shared_profile_description == '' || user_shared_profile_user_id == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_shared_profile_description != '' || user_shared_profile_user_id == '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Add User </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userSharedProfiles.store', 'id' => 'user_shared_profile_create']) !!}

            @include('user_shared_profiles.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection