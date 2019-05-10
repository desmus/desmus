@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project Topic D </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('user_project_topic_ds.show_fields')
          <a href="{!! route('userProjectTopicDs.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection