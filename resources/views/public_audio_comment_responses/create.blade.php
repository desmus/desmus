@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Audio Comment Response </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'publicAudioCommentResponses.store']) !!}

            @include('public_audio_comment_responses.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection