@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project Topic D </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
             
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectTopicD, ['route' => ['userProjectTopicDs.update', $userProjectTopicD->id], 'method' => 'patch']) !!}

            @include('user_project_topic_ds.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection