@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Audio Comment Response </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileAudioCResponse, ['route' => ['sharedProfileAudioCResponses.update', $sharedProfileAudioCResponse->id], 'method' => 'patch']) !!}

            @include('shared_profile_audio_c_responses.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection