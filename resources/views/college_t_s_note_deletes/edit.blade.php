@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Note Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSNoteDelete, ['route' => ['collegeTSNoteDeletes.update', $collegeTSNoteDelete->id], 'method' => 'patch']) !!}

            @include('college_t_s_note_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection