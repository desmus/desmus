@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">College T S File Updates</h1>

  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
                    
        @include('college_t_s_file_updates.table')
            
      </div>
        
    </div>
        
    <div class="text-center">
        
    </div>
  
  </div>

@endsection