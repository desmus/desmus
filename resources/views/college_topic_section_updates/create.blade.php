@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> College Topic Section Update </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">
    
      <div class="box-body">
      
        <div class="row">
                    
          {!! Form::open(['route' => 'collegeTopicSectionUpdates.store']) !!}

            @include('college_topic_section_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
  
  </div>
  
@endsection