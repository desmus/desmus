@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> U C T S P Audio Create </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'uCTSPAudioCreates.store']) !!}

            @include('u_c_t_s_p_audio_creates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection