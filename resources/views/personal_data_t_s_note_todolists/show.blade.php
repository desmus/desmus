@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $personalDataTSNoteTodolist -> name !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('personal_data_t_s_note_todolists.show_fields')
          <a href="{!! route('personalDataTSNotes.show', [$personalDataTSNoteTodolist -> p_d_t_s_n_id]) !!}" class="btn btn-default">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection