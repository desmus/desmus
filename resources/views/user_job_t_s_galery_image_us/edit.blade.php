@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job T S Galery Image U </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTSGaleryImageU, ['route' => ['userJobTSGaleryImageUs.update', $userJobTSGaleryImageU->id], 'method' => 'patch']) !!}

            @include('user_job_t_s_galery_image_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection