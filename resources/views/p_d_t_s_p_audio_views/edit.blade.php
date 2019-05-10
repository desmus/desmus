@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> P D T S P Audio View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($pDTSPAudioView, ['route' => ['pDTSPAudioViews.update', $pDTSPAudioView->id], 'method' => 'patch']) !!}

            @include('p_d_t_s_p_audio_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection