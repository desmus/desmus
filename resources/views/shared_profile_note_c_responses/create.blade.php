@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Note Comment Response </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'sharedProfileNoteCResponses.store']) !!}

            @include('shared_profile_note_c_responses.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection