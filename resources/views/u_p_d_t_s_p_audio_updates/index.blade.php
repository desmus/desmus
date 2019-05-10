@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">U P D T S P Audio Updates</h1>
    
  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
                    
        @include('u_p_d_t_s_p_audio_updates.table')
            
      </div>
        
    </div>
        
    <div class="text-center">
        
    </div>
    
  </div>

@endsection