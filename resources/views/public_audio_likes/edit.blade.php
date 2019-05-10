@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Audio Like </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicAudioLike, ['route' => ['publicAudioLikes.update', $publicAudioLike->id], 'method' => 'patch']) !!}

            @include('public_audio_likes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection