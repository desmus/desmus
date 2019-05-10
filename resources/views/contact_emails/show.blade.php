@extends('layouts.app')

@section('content')

  <section class="content-header">
    
    <h1> Contact Email </h1>
    
  </section>
  
  <div class="content">
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          @include('contact_emails.show_fields')
          <a href="{!! route('contacts.show', [$contactEmail -> contact_id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection