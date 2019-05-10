@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project T S Galery Image U </h1>
   
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userProjectTSGaleryImageU, ['route' => ['userProjectTSGaleryImageUs.update', $userProjectTSGaleryImageU->id], 'method' => 'patch']) !!}

            @include('user_project_t_s_galery_image_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection