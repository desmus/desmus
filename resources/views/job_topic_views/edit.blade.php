@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicView, ['route' => ['jobTopicViews.update', $jobTopicView->id], 'method' => 'patch']) !!}

            @include('job_topic_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection