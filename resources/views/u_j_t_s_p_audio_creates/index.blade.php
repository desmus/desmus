@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">U J T S P Audio Creates</h1>
  
  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
                    
        @include('u_j_t_s_p_audio_creates.table')
            
      </div>
        
    </div>
        
    <div class="text-center">
        
    </div>
    
  </div>

@endsection