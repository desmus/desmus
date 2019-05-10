@extends('layouts.app')

@section('content')
    
  <section class="content-header">
  
    <h1> Job Topic Todolist Create </h1>
  
  </section>
    
  <div class="content">
  
    <div class="box box-primary">
    
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('job_topic_todolist_creates.show_fields')
          <a href="{!! route('jobTopicTodolistCreates.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
  
  </div>

@endsection