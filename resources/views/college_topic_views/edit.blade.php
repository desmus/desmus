@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicView, ['route' => ['collegeTopicViews.update', $collegeTopicView->id], 'method' => 'patch']) !!}

            @include('college_topic_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection