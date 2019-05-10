@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Calendar Event Delete </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userCalendarEventDelete, ['route' => ['userCalendarEventDeletes.update', $userCalendarEventDelete->id], 'method' => 'patch']) !!}

            @include('user_calendar_event_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection