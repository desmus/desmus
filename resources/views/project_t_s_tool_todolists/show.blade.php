@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTSToolTodolist -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('project_t_s_tool_todolists.show_fields')
          <a href="{!! route('projectTSTools.show', [$projectTSToolTodolist -> p_t_s_t_id]) !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection