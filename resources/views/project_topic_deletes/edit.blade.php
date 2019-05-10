@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopicDelete, ['route' => ['projectTopicDeletes.update', $projectTopicDelete->id], 'method' => 'patch']) !!}

            @include('project_topic_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection