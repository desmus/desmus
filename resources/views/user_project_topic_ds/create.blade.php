@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project Topic D </h1>
    
  </section>
    
  <div class="content" style = 'margin-top: 20px'>
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userProjectTopicDs.store']) !!}

            @include('user_project_topic_ds.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection