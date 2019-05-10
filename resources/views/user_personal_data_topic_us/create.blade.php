@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data Topic U </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userPersonalDataTopicUs.store']) !!}

            @include('user_personal_data_topic_us.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection