@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">User Personal Data T S Tool File Ds</h1>
    
  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
                    
        @include('user_personal_data_t_s_tool_file_ds.table')
            
      </div>
        
    </div>
        
    <div class="text-center">
        
    </div>
    
  </div>

@endsection