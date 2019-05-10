@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College Topic C </h1>
  
  </section>
   
  <div class="content" style = 'margin-top: 20px'>
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userCollegeTopicC, ['route' => ['userCollegeTopicCs.update', $userCollegeTopicC->id], 'method' => 'patch']) !!}

            @include('user_college_topic_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection