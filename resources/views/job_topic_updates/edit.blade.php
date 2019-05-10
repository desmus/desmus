@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicUpdate, ['route' => ['jobTopicUpdates.update', $jobTopicUpdate->id], 'method' => 'patch']) !!}

            @include('job_topic_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection