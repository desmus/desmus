@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left">Job T S Tool Todolist Deletes</h1>
  
  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
        
    <div class="box box-primary">
            
      <div class="box-body">
        
        @include('job_t_s_tool_todolist_deletes.table')
      
      </div>
        
    </div>
        
    <div class="text-center">
        
    </div>
    
  </div>

@endsection