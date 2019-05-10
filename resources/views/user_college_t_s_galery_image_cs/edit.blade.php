@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College T S Galery Image C </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userCollegeTSGaleryImageC, ['route' => ['userCollegeTSGaleryImageCs.update', $userCollegeTSGaleryImageC->id], 'method' => 'patch']) !!}

            @include('user_college_t_s_galery_image_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>
  
@endsection