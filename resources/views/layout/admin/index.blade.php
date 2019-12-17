<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layout.admin._header')
<body class="no-skin">
@include('layout.admin.components')
<!-- navBar -->
@include('layout.admin._navbar')
<!-- /navbar -->
<div class="main-container ace-save-state" id="main-container">
   <script type="text/javascript">
       try {
           ace.settings.loadState('main-container')
       } catch (e) {
       }
   </script>

   <!-- MENU -->
@include('layout.admin._sidebar')
<!-- /MENU -->

   <div class="main-content">
      <div class="main-content-inner">

         <div class="page-content">
            <div class="ace-settings-container" id="ace-settings-container">
               <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                  <i class="ace-icon fa fa-cog bigger-130"></i>
               </div>

               <div class="ace-settings-box clearfix" id="ace-settings-box">
                  <div class="pull-left width-50">
                     <div class="ace-settings-item">
                        <div class="pull-left">
                           <select id="skin-colorpicker" class="hide">
                              <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                              <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                              <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                              <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                           </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar"
                               autocomplete="off"/>
                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar"
                               autocomplete="off"/>
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs"
                               autocomplete="off"/>
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off"/>
                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container"
                               autocomplete="off"/>
                        <label class="lbl" for="ace-settings-add-container">
                           Inside
                           <b>.container</b>
                        </label>
                     </div>
                  </div><!-- /.pull-left -->

                  <div class="pull-left width-50">
                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off"/>
                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off"/>
                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                     </div>

                     <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight"
                               autocomplete="off"/>
                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                     </div>
                  </div><!-- /.pull-left -->
               </div><!-- /.ace-settings-box -->
            </div>
            <!-- /.ace-settings-container -->
            <div class="row">
               <div class="col-xs-12" id="content-load">
                  <!-- PAGE CONTENT BEGINS -->
               @yield('content')
               <!-- PAGE CONTENT ENDS -->
               </div><!-- /.col -->
            </div><!-- /.row -->
         </div><!-- /.page-content -->
      </div>
   </div><!-- /.main-content -->

   <div class="footer">
      <div class="footer-inner">
         <div class="footer-content">
            <span class="bigger-120">
               <span class="blue bolder">{{ env('APP_NAME') }}</span>
              <a href="http://findhossein.ir/">developed by HOSSEIN HAGHPARAST</a> ; 2019
            </span>

            &nbsp; &nbsp;
            <span class="action-buttons">
               <a href="#">
                  <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
               </a>

               <a href="#">
                  <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
               </a>

               <a href="#">
                  <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
               </a>
            </span>
         </div>
      </div>
   </div>

   <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
      <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
   </a>
</div>
<!-- /.main-container -->

<!-- basic scripts -->


<script src="{{ asset('admin-assets/js/admin-app.js')}}"></script>
<!-- LOAD MY JS CODES  -->
<script src="{{ asset('admin-assets/js/myCodes.js')}}"></script>


<!-- LOAD PJAX -->
<script src="{{ asset('js/pjax/pjax.min.js') }}"></script>


<!-- ace scripts -->
@if (env('APP_AJAX'))
   <!-- script for load page on AJAX-->
   <script>
       jQuery(document).ready(function () {
           jQuery(".click_me").on('click', function (e) {
               e.preventDefault();
               var route = $(this).attr('href');
               var pjax = new Pjax({
                   selectors: ["title", "#extra_css", "#content-load", "#extra_js"]
               });
               pjax.loadUrl(route);
           });
       });
   </script>
@endif
<!-- END script for load page on ajax-->
<!-- SEARCH SCRIPT -->

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#form-search").submit(function (e) {
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                url: "{{ route('admin.search') }}",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $(".preview").show();
                }, success: function (data) {
                    if (data.html == " ") {
                        $('.preview').html("No more records found");
                        return;
                    }
                    $(".table_data").empty().append(data.html);
                    $('.preview').hide();
                }, error: function () {
                    alert('error');
                    $('.preview').hide();
                }
            })
        });
    });
{{--    @if(env('APP_AJAX'))--}}
{{--       <!-- LOAD THE EDIT PAGE-->--}}
{{--       jQuery(".edit_me").bind('click', function () {--}}
{{--           var route = $(this).attr('href');--}}
{{--           var pjax = new Pjax({--}}
{{--               selectors: ["title", "#extra_css", "#content-load", "#extra_js"]--}}
{{--           });--}}
{{--           pjax.loadUrl(route);--}}
{{--       });--}}
{{--    @endif--}}
</script>


<!-- /SEARCH SCRIPT -->
<!-- BEGIN EXTRA JS-->
<div id="extra_js">
   @yield('extra_js')
</div>
<!-- END EXTRA JS-->

</body>
</html>

