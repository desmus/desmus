@extends('layouts.app')

@section('content')

  <section class="content-header">
        
    <h1> Shared Profile Audio Like </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'sharedProfileAudioLikes.store']) !!}

            @include('shared_profile_audio_likes.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection