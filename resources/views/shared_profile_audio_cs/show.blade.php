@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Audio Comment </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('shared_profile_audio_cs.show_fields')
          <a href="{!! route('sharedProfileAudioCs.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
    
    </div>
    
  </div>

@endsection