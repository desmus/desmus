@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Calendar Event Update </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userCalendarEventUpdates.store']) !!}

            @include('user_calendar_event_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection