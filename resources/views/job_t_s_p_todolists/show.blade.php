@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTSPTodolist -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('job_t_s_p_todolists.show_fields')
          <a href="{!! route('jobTSPlaylists.show', [$jobTSPTodolist -> j_t_s_p_id]) !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection