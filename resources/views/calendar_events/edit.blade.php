@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> Calendar Event </h1>
    
  </section>
    
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($calendarEvent, ['route' => ['calendarEvents.update', $calendarEvent->id], 'method' => 'patch']) !!}
          
            @include('calendar_events.fields')
              
          {!! Form::close() !!}
            
        </div>
          
      </div>
        
    </div>
    
  </div>

@endsection