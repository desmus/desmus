@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicUpdate, ['route' => ['collegeTopicUpdates.update', $collegeTopicUpdate->id], 'method' => 'patch']) !!}

            @include('college_topic_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection