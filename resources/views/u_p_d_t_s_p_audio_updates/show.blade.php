@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U P D T S P Audio Update </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('u_p_d_t_s_p_audio_updates.show_fields')
          <a href="{!! route('uPDTSPAudioUpdates.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection