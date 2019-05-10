@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Section Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopicSectionCreate, ['route' => ['projectTopicSectionCreates.update', $projectTopicSectionCreate->id], 'method' => 'patch']) !!}

            @include('project_topic_section_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection