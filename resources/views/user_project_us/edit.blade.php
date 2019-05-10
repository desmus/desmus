@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project U </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
          
      <div class="box-body">
        
        <div class="row">
                   
          {!! Form::model($userProjectU, ['route' => ['userProjectUs.update', $userProjectU->id], 'method' => 'patch']) !!}

            @include('user_project_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection