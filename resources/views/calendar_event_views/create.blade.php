@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Calendar Event View </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::open(['route' => 'calendarEventViews.store']) !!}
          
            @include('calendar_event_views.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
@endsection