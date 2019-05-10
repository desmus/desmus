@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project C </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectC, ['route' => ['userProjectCs.update', $userProjectC->id], 'method' => 'patch']) !!}

            @include('user_project_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection