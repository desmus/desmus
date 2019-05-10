@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U P T S P Audio Create </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($uPTSPAudioCreate, ['route' => ['uPTSPAudioCreates.update', $uPTSPAudioCreate->id], 'method' => 'patch']) !!}

            @include('u_p_t_s_p_audio_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection