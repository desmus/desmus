@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project Topic C </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectTopicC, ['route' => ['userProjectTopicCs.update', $userProjectTopicC->id], 'method' => 'patch']) !!}

            @include('user_project_topic_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection