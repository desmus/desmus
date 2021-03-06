@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S Note Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSNoteCreate, ['route' => ['projectTSNoteCreates.update', $projectTSNoteCreate->id], 'method' => 'patch']) !!}

            @include('project_t_s_note_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection