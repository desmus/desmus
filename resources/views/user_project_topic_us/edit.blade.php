@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project Topic U </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectTopicU, ['route' => ['userProjectTopicUs.update', $userProjectTopicU->id], 'method' => 'patch']) !!}

            @include('user_project_topic_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection