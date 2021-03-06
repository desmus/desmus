@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Audio Comment </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileAudioC, ['route' => ['sharedProfileAudioCs.update', $sharedProfileAudioC->id], 'method' => 'patch']) !!}

            @include('shared_profile_audio_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
  
  </div>

@endsection