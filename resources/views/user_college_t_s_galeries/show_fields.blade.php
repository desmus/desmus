<section class="content" style="min-height: 0;">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#share_list" data-toggle="tab"> Actual Shares </a></li>
          <li><a href="{!! route('userCollegeTSGaleries.create', [$id]) !!}"> Add User </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "share_list">

            @include('user_college_t_s_galeries.filtered_table')

          </div>

        </div>

      </div>
              
    </div>
            
  </div>

</section>