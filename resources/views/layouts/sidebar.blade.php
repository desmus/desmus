<aside class="main-sidebar" id="sidebar-wrapper">

  <section class="sidebar">

    <div class="user-panel">
            
      <div class="pull-left image">
                
        <img src="/images/users/image_{!! Auth::user()->id !!}.{!! Auth::user()->image_type !!}" class="img-circle" alt="User Image"/>
            
      </div>
            
      <div class="pull-left info">
                
        @if (Auth::guest())
                
          <p>InfyOm</p>
                
        @else
                    
          <p>{{ Auth::user()->name}}</p>
                
        @endif
          
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            
      </div>
        
    </div>

    <form action="{!! route('generalSearches.index') !!}" method="get" class="sidebar-form">
            
      <div class="input-group">
                
        <input id='principal_search' type="text" name="search" class="form-control" placeholder="Search..."/>
          
        <span class="input-group-btn">
            
          <button type='submit' id='search-btn' class="btn btn-flat"> <i class="fa fa-search"></i> </button>
          
        </span>
            
      </div>
        
    </form>

    <ul class="sidebar-menu">
            
      @include('layouts.menu')
        
    </ul>
    
  </section>
    
</aside>