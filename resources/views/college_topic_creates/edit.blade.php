@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Create </h1>
  
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicCreate, ['route' => ['collegeTopicCreates.update', $collegeTopicCreate->id], 'method' => 'patch']) !!}

            @include('college_topic_creates.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection