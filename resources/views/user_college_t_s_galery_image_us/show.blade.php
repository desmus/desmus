@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College T S Galery Image U </h1>
  
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('user_college_t_s_galery_image_us.show_fields')
          <a href="{!! route('userCollegeTSGaleryImageUs.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection