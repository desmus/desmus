@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> Job T S Tool Todolist Delete </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'jobTSToolTodolistDeletes.store']) !!}

            @include('job_t_s_tool_todolist_deletes.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection