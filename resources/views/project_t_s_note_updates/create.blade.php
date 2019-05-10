@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S Note Update </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'projectTSNoteUpdates.store']) !!}

            @include('project_t_s_note_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
  
  </div>

@endsection