@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding: 0">
                    
          @include('contacts.show_fields')
          <a href="{!! route('homes.index') !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
          <a href="{!! route('contactAddresses.create', [$contact[0]-> id]) !!}" class="btn btn-default">Add Address</a>
          <a href="{!! route('contactTelephones.create', [$contact[0] -> id]) !!}" class="btn btn-default">Add Telephone</a>
          <a href="{!! route('contactEmails.create', [$contact[0] -> id]) !!}" class="btn btn-default">Add Email</a>
          <a href="{!! route('contactSocials.create', [$contact[0] -> id]) !!}" class="btn btn-default">Add Social Media</a>
          <a href="{!! route('contactWebs.create', [$contact[0] -> id]) !!}" class="btn btn-default">Add Web Page</a>
                
        </div>
            
      </div>
        
    </div>
  
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
    
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class = "active">
        
        <a href="#contact_addresses" data-toggle="tab">
        
          <i class="fa fa-address-card-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#contact_telephones" data-toggle="tab">
        
          <i class="fa fa-phone"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#contact_emails" data-toggle="tab">
        
          <i class="fa fa-envelope-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#contact_socials" data-toggle="tab">
        
          <i class="fa fa-user-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#contact_webs" data-toggle="tab">
        
          <i class="fa fa-globe"></i>
        
        </a>
        
      </li>
    
    </ul>
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li>
        
        <a href="#contact_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#contact_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="contact_addresses">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Addresses </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactAddressesList as $contactAddressList)
            
              <li>
                
                <a href="{!! route('contactAddresses.show', [$contactAddressList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-address-card-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactAddressList -> street !!} </h4>
                    <p> {!! $contactAddressList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="contact_telephones">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Telephones </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactTelephonesList as $contactTelephoneList)
            
              <li>
                
                <a href="{!! route('contactTelephones.show', [$contactTelephoneList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-phone bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactTelephoneList -> telephone !!} </h4>
                    <p> {!! $contactTelephoneList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="contact_emails">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Emails </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactEmailsList as $contactEmailList)
            
              <li>
                
                <a href="{!! route('contactEmails.show', [$contactEmailList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactEmailList -> email !!} </h4>
                    <p> {!! $contactEmailList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="contact_socials">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Socials </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactSocialsList as $contactSocialList)
            
              <li>
                
                <a href="{!! route('contactSocials.show', [$contactSocialList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-user-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactSocialList -> link !!} </h4>
                    <p> {!! $contactSocialList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="contact_webs">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Webs </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactWebsList as $contactWebList)
            
              <li>
                
                <a href="{!! route('contactWebs.show', [$contactWebList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-globe bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactWebList -> link !!} </h4>
                    <p> {!! $contactWebList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="contact_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactViewsList as $contactViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactViewList -> name !!} </h4>
                    <p> {!! $contactViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="contact_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Contact Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($contactUpdatesList as $contactUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $contactUpdateList -> name !!} </h4>
                    <p> {!! $contactUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection