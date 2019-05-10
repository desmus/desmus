@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S Galery Image Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTSGaleryImageUpdate, ['route' => ['personalDataTSGaleryImageUpdates.update', $personalDataTSGaleryImageUpdate->id], 'method' => 'patch']) !!}

            @include('personal_data_t_s_galery_image_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection