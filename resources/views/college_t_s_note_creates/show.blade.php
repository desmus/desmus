@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Note Create </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('college_t_s_note_creates.show_fields')
          <a href="{!! route('collegeTSNoteCreates.index') !!}" class="btn btn-default">Back</a>
        
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection