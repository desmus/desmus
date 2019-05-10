@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project T S Note D </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectTSNoteD, ['route' => ['userProjectTSNoteDs.update', $userProjectTSNoteD->id], 'method' => 'patch']) !!}

            @include('user_project_t_s_note_ds.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection