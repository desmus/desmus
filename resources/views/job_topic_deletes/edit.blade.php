@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicDelete, ['route' => ['jobTopicDeletes.update', $jobTopicDelete->id], 'method' => 'patch']) !!}

            @include('job_topic_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection