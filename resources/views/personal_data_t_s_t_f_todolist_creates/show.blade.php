@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S T F Todolist Create </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('personal_data_t_s_t_f_todolist_creates.show_fields')
          <a href="{!! route('personalDataTSTFTodolistCreates.index') !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection