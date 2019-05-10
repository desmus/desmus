@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S File Delete </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('personal_data_t_s_file_deletes.show_fields')
          <a href="{!! route('personalDataTSFileDeletes.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection