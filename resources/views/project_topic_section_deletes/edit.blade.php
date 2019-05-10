@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> Project Topic Section Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopicSectionDelete, ['route' => ['projectTopicSectionDeletes.update', $projectTopicSectionDelete->id], 'method' => 'patch']) !!}

            @include('project_topic_section_deletes.fields')

          {!! Form::close() !!}
              
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection