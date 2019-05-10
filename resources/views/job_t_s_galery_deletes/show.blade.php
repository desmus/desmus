@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> Job T S Galery Delete </h1>
  
  </section>
    
  <div class="content">
    
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('job_t_s_galery_deletes.show_fields')
          <a href="{!! route('jobTSGaleryDeletes.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection