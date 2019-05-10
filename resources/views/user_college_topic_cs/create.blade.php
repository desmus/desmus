@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College Topic C </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userCollegeTopicCs.store']) !!}

            @include('user_college_topic_cs.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
       
    </div>
    
  </div>

@endsection