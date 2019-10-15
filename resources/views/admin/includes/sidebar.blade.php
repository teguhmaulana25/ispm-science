<!-- Main Sidebar start-->
<aside data-mcs-theme="minimal-dark" style="background-image: url({{ asset('build/images/backgrounds/11.jpg') }})" class="main-sidebar mCustomScrollbar">
    <div class="user">
        <div id="esp-user-profile" data-percent="65" style="height: 130px; width: 130px; line-height: 100px; padding: 15px;" class="easy-pie-chart"><img src="{{ asset('build/images/users/04.jpg') }}" alt="" class="avatar img-circle"><span class="status bg-success"></span></div>
        <h4 class="fs-16 text-muted mt-15 mb-5 fw-300">Matthew Gonzalez</h4>
        <p class="mb-0 text-muted">Designer</p>
    </div>
    <ul class="list-unstyled navigation mb-0">
        <li class="sidebar-category">Main</li>
        <li class="panel"><a href="{{ route('dashboard') }}"><i class="ti-home"></i><span class="sidebar-title">Dashboard</span></a></li>
        <li class="panel">
            <a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse1" aria-expanded="false" aria-controls="collapse1" class="bubble active collapsed">
                <i class="ti-home"></i><span class="sidebar-title">Dashboard</span>
            </a>
            <ul id="collapse1" class="list-unstyled collapse">
                <li><a href="index.html">Dashboard v1</a></li>
                <li><a href="index-v2.html" class="active">Dashboard v2</a></li>
            </ul>
        </li>
        <li class="panel"><a href="widgets.html"><i class="ti-panel"></i><span class="sidebar-title">Widgets </span><span class="label label-outline label-danger">Updated</span></a></li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse3" aria-expanded="false" aria-controls="collapse3" class="collapsed"><i class="ti-shopping-cart"></i><span class="sidebar-title">E-commerce</span></a>
        <ul id="collapse3" class="list-unstyled collapse">
        <li><a href="ecommerce-dashboard.html">Dashboard</a></li>
        <li><a href="product-list.html">Product list</a></li>
        <li><a href="edit-product.html">Edit product</a></li>
        <li><a href="order-list.html">Order list</a></li>
        <li><a href="edit-order.html">Edit order</a></li>
        <li><a href="customer-list.html">Customer list</a></li>
        <li><a href="edit-customer.html">Edit customer</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse4" aria-expanded="false" aria-controls="collapse4" class="collapsed"><i class="ti-paint-bucket"></i><span class="sidebar-title">Color system</span></a>
        <ul id="collapse4" class="list-unstyled collapse">
        <li><a href="green-system.html">Green</a></li>
        <li><a href="blue-system.html">Blue</a></li>
        <li><a href="purple-system.html">Purple</a></li>
        <li><a href="red-system.html">Red</a></li>
        <li><a href="yellow-system.html">Yellow</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse5" aria-expanded="false" aria-controls="collapse5" class="collapsed"><i class="ti-brush-alt"></i><span class="sidebar-title">Skins</span></a>
        <ul id="collapse5" class="list-unstyled collapse">
        <li><a href="green-dashboard.html">Green</a></li>
        <li><a href="blue-dashboard.html">Blue</a></li>
        <li><a href="purple-dashboard.html">Purple</a></li>
        <li><a href="red-dashboard.html">Red</a></li>
        <li><a href="yellow-dashboard.html">Yellow</a></li>
        </ul>
        </li>
        <li class="sidebar-category">Menu Levels</li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse20" aria-expanded="false" aria-controls="collapse20" class="collapsed"><i class="ti-folder"></i><span class="sidebar-title">Menu levels</span></a>
        <ul id="collapse20" class="list-unstyled collapse">
        <li><a role="button" data-toggle="collapse" data-parent="#collapse20" href="#collapse201" aria-expanded="false" aria-controls="collapse201" class="collapsed">Menu level 2.1</a>
            <ul id="collapse201" class="list-unstyled collapse">
            <li><a href="#">Menu level 3.1</a></li>
            <li><a href="#">Menu level 3.2</a></li>
            <li><a href="#">Menu level 3.3</a></li>
            </ul>
        </li>
        <li><a role="button" data-toggle="collapse" data-parent="#collapse20" href="#collapse202" aria-expanded="false" aria-controls="collapse202" class="collapsed">Menu level 2.2</a>
            <ul id="collapse202" class="list-unstyled collapse">
            <li><a href="#">Menu level 3.4</a></li>
            <li><a role="button" data-toggle="collapse" data-parent="#collapse202" href="#collapse302" aria-expanded="false" aria-controls="collapse302" class="collapsed">Menu level 3.5</a>
                <ul id="collapse302" class="list-unstyled collapse">
                <li><a href="#">Menu level 4.1</a></li>
                <li><a role="button" data-toggle="collapse" data-parent="#collapse302" href="#collapse402" aria-expanded="false" aria-controls="collapse402" class="collapsed">Menu level 4.2</a>
                    <ul id="collapse402" class="list-unstyled collapse">
                    <li><a href="#">Menu level 5.1</a></li>
                    <li><a href="#">Menu level 5.2</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <li><a href="#">Menu level 3.6</a></li>
            </ul>
        </li>
        <li><a role="button" data-toggle="collapse" data-parent="#collapse20" href="#collapse203" aria-expanded="false" aria-controls="collapse203" class="collapsed">Menu level 2.3</a>
            <ul id="collapse203" class="list-unstyled collapse">
            <li><a href="#">Menu level 3.7</a></li>
            <li><a href="#">Menu level 3.8</a></li>
            <li><a href="#">Menu level 3.9</a></li>
            </ul>
        </li>
        </ul>
        </li>
        <li class="sidebar-category">Components</li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse6" aria-expanded="false" aria-controls="collapse6" class="collapsed"><i class="ti-receipt"></i><span class="sidebar-title">Basic</span></a>
        <ul id="collapse6" class="list-unstyled collapse">
        <li><a href="buttons.html">Buttons</a></li>
        <li><a href="carousels.html">Carousels</a></li>
        <li><a href="containers.html">Containers</a></li>
        <li><a href="dialogs.html">Dialogs</a></li>
        <li><a href="basic-inputs.html">Inputs</a></li>
        <li><a href="navigations.html">Navigations</a></li>
        <li><a href="progress-bars.html">Progress bars</a></li>
        <li><a href="typography.html">Typography</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse7" aria-expanded="false" aria-controls="collapse7" class="collapsed"><i class="ti-ruler-pencil"></i><span class="sidebar-title">Editors</span></a>
        <ul id="collapse7" class="list-unstyled collapse">
        <li><a href="summernote.html">Summernote</a></li>
        <li><a href="bootstrap-markdown.html">Bootstrap markdown</a></li>
        <li><a href="code-prettify.html">Code prettify</a></li>
        <li><a href="ckeditor.html">CKEditor</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse8" aria-expanded="false" aria-controls="collapse8" class="collapsed"><i class="ti-location-arrow"></i><span class="sidebar-title">Pickers</span></a>
        <ul id="collapse8" class="list-unstyled collapse">
        <li><a href="color-picker.html">Color picker</a></li>
        <li><a href="datetime-picker.html">Datetime picker</a></li>
        <li><a href="clock-picker.html">Clock picker</a></li>
        <li><a href="date-range-picker.html">Date range picker</a></li>
        <li><a href="multi-select.html">Multi select</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse9" aria-expanded="false" aria-controls="collapse9" class="collapsed"><i class="ti-layers-alt"></i><span class="sidebar-title">Forms</span></a>
        <ul id="collapse9" class="list-unstyled collapse">
        <li><a href="forms-layouts.html">Layouts</a></li>
        <li><a href="forms-validation.html">Validation</a></li>
        <li><a href="forms-wizard.html">Wizard</a></li>
        <li><a href="other-plugins.html">Other plugins</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse10" aria-expanded="false" aria-controls="collapse10" class="collapsed"><i class="ti-face-smile"></i><span class="sidebar-title">Icons</span></a>
        <ul id="collapse10" class="list-unstyled collapse">
        <li><a href="glyphicons.html">Glyphicons</a></li>
        <li><a href="font-awesome.html">Font awesome</a></li>
        <li><a href="material-design.html">Material design</a></li>
        <li><a href="themify.html">Themify</a></li>
        <li><a href="weather-icons.html">Weather</a></li>
        <li><a href="flag-icons.html">Flag</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse11" aria-expanded="false" aria-controls="collapse11" class="collapsed"><i class="ti-layout-grid2"></i><span class="sidebar-title">Tables</span></a>
        <ul id="collapse11" class="list-unstyled collapse">
        <li><a href="basic-tables.html">Basic tables</a></li>
        <li><a href="data-tables.html">Data tables</a></li>
        <li><a href="pricing-tables.html">Pricing tables</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse12" aria-expanded="false" aria-controls="collapse12" class="collapsed"><i class="ti-control-forward"></i><span class="sidebar-title">Animations</span></a>
        <ul id="collapse12" class="list-unstyled collapse">
        <li><a href="basic-animations.html">Basic</a></li>
        <li><a href="loading-animations.html">Loading</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse13" aria-expanded="false" aria-controls="collapse13" class="collapsed"><i class="ti-upload"></i><span class="sidebar-title">File uploads</span></a>
        <ul id="collapse13" class="list-unstyled collapse">
        <li><a href="dropzone-js.html">Dropzone</a></li>
        <li><a href="bootstrap-file-input.html">Bootstrap file input</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse14" aria-expanded="false" aria-controls="collapse14" class="collapsed"><i class="ti-info-alt"></i><span class="sidebar-title">Indicators</span></a>
        <ul id="collapse14" class="list-unstyled collapse">
        <li><a href="toastr.html">Toastr</a></li>
        <li><a href="sweet-alert.html">Sweet alert</a></li>
        </ul>
        </li>
        <li class="sidebar-category">Data visualization</li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse15" aria-expanded="false" aria-controls="collapse15" class="collapsed"><i class="ti-bar-chart"></i><span class="sidebar-title">Charts</span></a>
        <ul id="collapse15" class="list-unstyled collapse">
        <li><a href="flot-charts.html">Flot charts</a></li>
        <li><a href="morris-charts.html">Morris charts</a></li>
        <li><a href="chart-js.html">Chart.js</a></li>
        <li><a href="chartist.html">Chartist</a></li>
        <li><a href="other-charts.html">Other charts</a></li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse16" aria-expanded="false" aria-controls="collapse16" class="collapsed"><i class="ti-location-pin"></i><span class="sidebar-title">Maps</span></a>
        <ul id="collapse16" class="list-unstyled collapse">
        <li><a href="vector-maps.html">Vector maps</a></li>
        <li><a href="google-maps.html">Google maps</a></li>
        </ul>
        </li>
        <li class="sidebar-category">Page kits</li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse17" aria-expanded="false" aria-controls="collapse17" class="collapsed"><i class="ti-alert"></i><span class="sidebar-title">Error pages</span></a>
        <ul id="collapse17" class="list-unstyled collapse">
        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#collapse17" href="#collapse171" aria-expanded="false" aria-controls="collapse171" class="collapsed">Error pages v1</a>
            <ul id="collapse171" class="list-unstyled collapse">
            <li><a href="error-400.html">Error 400</a></li>
            <li><a href="error-401.html">Error 401</a></li>
            <li><a href="error-403.html">Error 403</a></li>
            <li><a href="error-404.html">Error 404</a></li>
            <li><a href="error-500.html">Error 500</a></li>
            <li><a href="error-503.html">Error 503</a></li>
            </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#collapse17" href="#collapse172" aria-expanded="false" aria-controls="collapse172" class="collapsed">Error pages v2</a>
            <ul id="collapse172" class="list-unstyled collapse">
            <li><a href="error-400-v2.html">Error 400</a></li>
            <li><a href="error-401-v2.html">Error 401</a></li>
            <li><a href="error-403-v2.html">Error 403</a></li>
            <li><a href="error-404-v2.html">Error 404</a></li>
            <li><a href="error-500-v2.html">Error 500</a></li>
            <li><a href="error-503-v2.html">Error 503</a></li>
            </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#collapse17" href="#collapse173" aria-expanded="false" aria-controls="collapse173" class="collapsed">Error pages v3</a>
            <ul id="collapse173" class="list-unstyled collapse">
            <li><a href="error-400-v3.html">Error 400</a></li>
            <li><a href="error-401-v3.html">Error 401</a></li>
            <li><a href="error-403-v3.html">Error 403</a></li>
            <li><a href="error-404-v3.html">Error 404</a></li>
            <li><a href="error-500-v3.html">Error 500</a></li>
            <li><a href="error-503-v3.html">Error 503</a></li>
            </ul>
        </li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse18" aria-expanded="false" aria-controls="collapse18" class="collapsed"><i class="ti-user"></i><span class="sidebar-title">User pages</span></a>
        <ul id="collapse18" class="list-unstyled collapse">
        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#collapse18" href="#collapse181" aria-expanded="false" aria-controls="collapse181" class="collapsed">User pages v1</a>
            <ul id="collapse181" class="list-unstyled collapse">
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="forgot-password.html">Forgot password</a></li>
            <li><a href="lock-screen.html">Lock screen</a></li>
            <li><a href="profile.html">Profile</a></li>
            </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#collapse18" href="#collapse182" aria-expanded="false" aria-controls="collapse182" class="collapsed">User pages v2</a>
            <ul id="collapse182" class="list-unstyled collapse">
            <li><a href="login-v2.html">Login</a></li>
            <li><a href="register-v2.html">Register</a></li>
            <li><a href="forgot-password-v2.html">Forgot password</a></li>
            <li><a href="lock-screen-v2.html">Lock screen</a></li>
            <li><a href="profile-v2.html">Profile</a></li>
            </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#collapse18" href="#collapse183" aria-expanded="false" aria-controls="collapse183" class="collapsed">User pages v3</a>
            <ul id="collapse183" class="list-unstyled collapse">
            <li><a href="login-v3.html">Login</a></li>
            <li><a href="register-v3.html">Register</a></li>
            <li><a href="forgot-password-v3.html">Forgot password</a></li>
            <li><a href="lock-screen-v3.html">Lock screen</a></li>
            <li><a href="profile-v3.html">Profile</a></li>
            </ul>
        </li>
        </ul>
        </li>
        <li class="panel"><a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse19" aria-expanded="false" aria-controls="collapse19" class="collapsed"><i class="ti-blackboard"></i><span class="sidebar-title">Extra pages </span><span class="label label-outline label-success">Updated</span></a>
        <ul id="collapse19" class="list-unstyled collapse">
        <li><a href="chat-dashboard.html">Chat dashboard</a></li>
        <li><a href="mailbox.html">Mailbox</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="image-cropper.html">Image cropper</a></li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="timeline.html">Timeline</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="search-results.html">Search results</a></li>
        <li><a href="blank-template.html">Blank template</a></li>
        </ul>
        </li>
        <li class="sidebar-category">Help</li>
        <li class="panel"><a href="documentation.html"><i class="ti-help-alt"></i><span class="sidebar-title">Documentation</span></a></li>
    </ul>
<div class="sidebar-category">Server Status</div>
<div class="sidebar-widget">
<ul class="list-unstyled pl-25 pr-25">
<li class="mb-20">
<div class="block clearfix mb-10"><span class="pull-left fs-12 text-muted">CPU Used</span><span class="pull-right label label-outline label-warning">65%</span></div>
<div class="progress progress-xs bg-light mb-0">
    <div role="progressbar" data-transitiongoal="65" class="progress-bar progress-bar-warning"></div>
</div>
</li>
<li class="mb-20">
<div class="block clearfix mb-10"><span class="pull-left fs-12 text-muted">Bandwidth</span><span class="pull-right label label-outline label-danger">80%</span></div>
<div class="progress progress-xs bg-light mb-0">
    <div role="progressbar" data-transitiongoal="80" class="progress-bar progress-bar-danger"></div>
</div>
</li>
</ul>
</div>
</aside>