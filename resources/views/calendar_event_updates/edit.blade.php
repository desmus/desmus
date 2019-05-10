@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Calendar Event Update </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($calendarEventUpdate, ['route' => ['calendarEventUpdates.update', $calendarEventUpdate->id], 'method' => 'patch']) !!}
          
            @include('calendar_event_updates.fields')
            
          {!! Form::close() !!}
          
        </div>
    
      </div>
      
    </div>
    
  </div>

@endsection