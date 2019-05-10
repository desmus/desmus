@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Audio View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileAudioView, ['route' => ['sharedProfileAudioViews.update', $sharedProfileAudioView->id], 'method' => 'patch']) !!}

            @include('shared_profile_audio_views.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection