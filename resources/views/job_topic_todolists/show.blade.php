@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTopicTodolist -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('job_topic_todolists.show_fields')
          <a href="{!! route('jobTopics.show', [$jobTopicTodolist -> job_topic_id]) !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection