@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTodolist -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('project_todolists.show_fields')
          <a href="{!! route('projects.show', [$projectTodolist -> project_id]) !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection