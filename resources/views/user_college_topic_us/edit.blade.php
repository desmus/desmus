@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College Topic U </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userCollegeTopicU, ['route' => ['userCollegeTopicUs.update', $userCollegeTopicU->id], 'method' => 'patch']) !!}

            @include('user_college_topic_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection