@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">P D T S P Audio Views</h1>
    
  </section>
    
  <div class="content" style = 'magrin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
                    
        @include('p_d_t_s_p_audio_views.table')
            
      </div>
    
    </div>
        
    <div class="text-center">
        
    </div>
    
  </div>

@endsection