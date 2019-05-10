@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S G Image Todolist Create </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'jobTSGImageTodolistCreates.store']) !!}

            @include('job_t_s_g_image_todolist_creates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection