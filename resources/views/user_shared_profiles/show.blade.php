@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $userSharedProfiles[0] -> name !!} - Share List </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('user_shared_profiles.show_fields')
          <a href="{!! route('sharedProfile.index') !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
@endsection