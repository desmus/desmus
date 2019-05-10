@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project T S Galerie D </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectTSGalerieD, ['route' => ['userProjectTSGalerieDs.update', $userProjectTSGalerieD->id], 'method' => 'patch']) !!}

            @include('user_project_t_s_galerie_ds.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection