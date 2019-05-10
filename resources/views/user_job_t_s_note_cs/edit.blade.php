@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job T S Note C </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTSNoteC, ['route' => ['userJobTSNoteCs.update', $userJobTSNoteC->id], 'method' => 'patch']) !!}

            @include('user_job_t_s_note_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection