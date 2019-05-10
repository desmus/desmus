@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U J T S P Audio Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($uJTSPAudioDelete, ['route' => ['uJTSPAudioDeletes.update', $uJTSPAudioDelete->id], 'method' => 'patch']) !!}

            @include('u_j_t_s_p_audio_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection