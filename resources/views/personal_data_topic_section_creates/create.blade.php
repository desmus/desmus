@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> Personal Data Topic Section Create </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTopicSectionCreates.store']) !!}

            @include('personal_data_topic_section_creates.fields')

          {!! Form::close() !!}
        
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection