@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job Topic D </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTopicD, ['route' => ['userJobTopicDs.update', $userJobTopicD->id], 'method' => 'patch']) !!}

            @include('user_job_topic_ds.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection