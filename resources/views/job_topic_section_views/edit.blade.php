@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> Job Topic Section View </h1>
  
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
        
        <div class="row">
                   
          {!! Form::model($jobTopicSectionView, ['route' => ['jobTopicSectionViews.update', $jobTopicSectionView->id], 'method' => 'patch']) !!}

            @include('job_topic_section_views.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
   
  </div>

@endsections