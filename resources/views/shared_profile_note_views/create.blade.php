@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Note View </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
        
        <div class="row">
                    
          {!! Form::open(['route' => 'sharedProfileNoteViews.store']) !!}

            @include('shared_profile_note_views.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection