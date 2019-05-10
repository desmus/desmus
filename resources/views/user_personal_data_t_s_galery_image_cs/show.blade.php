@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data T S Galery Image C </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('user_personal_data_t_s_galery_image_cs.show_fields')
          <a href="{!! route('userPersonalDataTSGaleryImageCs.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>

  </div>

@endsection