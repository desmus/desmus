@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U P D T S P Audio Create </h1>
  
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('u_p_d_t_s_p_audio_creates.show_fields')
          <a href="{!! route('uPDTSPAudioCreates.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection