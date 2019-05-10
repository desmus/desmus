@extends('layouts.app')

@section('content')
  
  <section class="content-header">
    
    <h1> College Topic Section Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicSectionUpdate, ['route' => ['collegeTopicSectionUpdates.update', $collegeTopicSectionUpdate->id], 'method' => 'patch']) !!}

            @include('college_topic_section_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection