@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S P Audio Update </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'projectTSPAudioUpdates.store']) !!}

            @include('project_t_s_p_audio_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection