@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> User College T S Note U </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
      
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userCollegeTSNoteU, ['route' => ['userCollegeTSNoteUs.update', $userCollegeTSNoteU->id], 'method' => 'patch']) !!}

            @include('user_college_t_s_note_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection