@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Image Update </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileImageUpdate, ['route' => ['sharedProfileImageUpdates.update', $sharedProfileImageUpdate->id], 'method' => 'patch']) !!}

            @include('shared_profile_image_updates.fields')

          {!! Form::close() !!}
        
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection