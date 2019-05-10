@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S G Image Todolist </h1>
  
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
      
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('job_t_s_g_image_todolists.show_fields')
          <a href="{!! route('jobTSGImageTodolists.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection