@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopicUpdate, ['route' => ['projectTopicUpdates.update', $projectTopicUpdate->id], 'method' => 'patch']) !!}

            @include('project_topic_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection