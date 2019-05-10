@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $personalDataTodolist -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('personal_data_todolists.show_fields')
          <a href="{!! route('personalDatas.show', [$personalDataTodolist -> personal_data_id]) !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection