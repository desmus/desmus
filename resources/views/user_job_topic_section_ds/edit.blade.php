@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job Topic Section D </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTopicSectionD, ['route' => ['userJobTopicSectionDs.update', $userJobTopicSectionD->id], 'method' => 'patch']) !!}

            @include('user_job_topic_section_ds.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection