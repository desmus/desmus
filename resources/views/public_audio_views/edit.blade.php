@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Audio View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicAudioView, ['route' => ['publicAudioViews.update', $publicAudioView->id], 'method' => 'patch']) !!}

            @include('public_audio_views.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection