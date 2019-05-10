@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_shared_profile_update').on('submit', function() {
      
      var user_shared_profile_permissions = document.getElementById("permissions").value;
      
      if(user_shared_profile_permissions == '')
      {
        alert("You need to assign a type of permission.");
        return false;
      }
      
      if(user_shared_profile_permissions != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!!$userSharedProfile[0] -> name !!} </h1>
  
  </section>
   
  <div class="content">
   
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userSharedProfile, ['route' => ['userSharedProfiles.update', $userSharedProfile[0]->id], 'method' => 'patch', 'id' => 'user_shared_profile_update']) !!}

            @include('user_shared_profiles.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection