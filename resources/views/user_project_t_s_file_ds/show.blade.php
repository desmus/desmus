@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Project T S File D </h1>
    
  </section>
    
  <div class="content">
    
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('user_project_t_s_file_ds.show_fields')
          <a href="{!! route('userProjectTSFileDs.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection