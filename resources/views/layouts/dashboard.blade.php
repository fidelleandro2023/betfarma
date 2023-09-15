<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1"> 
      <title></title>
      <meta name="author" content="">
      @include('dashboard.head')
    </head>
    <body class="dashboard dashboard_1">
      <div class="full_container">
        <div class="inner_container">
          <nav id="sidebar">
          @include('dashboard.sidebar')
          </nav>
          <div id="content">
            <!-- topbar -->
            <div class="topbar">
              <nav class="navbar navbar-expand-lg navbar-light">
                <div class="full">
                  <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                  <div class="logo_section">
                    <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a>
                  </div>
                  <div class="right_topbar">  
                   @include('dashboard.topbar')
                  </div>
                </div>
             </nav>
            </div>
            <div class="midde_cont">
             <div class="container-fluid">
               @yield('content')
             </div>
             <div class="container-fluid">
               <div class="footer">
                 @include('dashboard.footer')
               </div> 
             </div>
           </div>
         </div>
      </div>
  </div> 
 </body>
</html>
