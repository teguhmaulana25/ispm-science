<!-- Right Sidebar start-->
<aside class="right-sidebar closed">
  <ul role="tablist" class="nav nav-tabs nav-justified nav-sidebar">
    <li role="presentation" class="active"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab"><i class="ti-comment-alt"></i></a></li>
    <li role="presentation"><a href="#announcement" aria-controls="announcement" role="tab" data-toggle="tab"><i class="ti-announcement"></i></a></li>
    <li role="presentation"><a href="#ticket" aria-controls="ticket" role="tab" data-toggle="tab"><i class="ti-bookmark-alt"></i></a></li>
    <li role="presentation"><a href="#setting" aria-controls="setting" role="tab" data-toggle="tab"><i class="ti-settings"></i></a></li>
  </ul>
  <div data-mcs-theme="minimal-dark" class="tab-content nav-sidebar-content mCustomScrollbar">
    <div id="chat" role="tabpanel" class="tab-pane fade in active">
      <form>
        <div class="form-group has-feedback">
          <input type="text" aria-describedby="inputChatSearch" placeholder="Chat with..." class="form-control rounded"><span aria-hidden="true" class="ti-search form-control-feedback"></span><span id="inputChatSearch" class="sr-only">(default)</span>
        </div>
      </form>
      <ul class="chat-list mb-0 fs-12 media-list">
        <li class="media">
          <a href="javascript:;" class="conversation-toggle">
            <div class="media-left avatar">
              <img src="{{ URL::to('src/images/04.jpg') }}" alt="" class="media-object img-circle"><span class="status bg-success"></span>
            </div>
            <div class="media-body">
              <h6 class="media-heading">Jane Curtis</h6>
              <p class="text-muted mb-0">Where are you from?</p>
            </div>
            <div class="media-right"><span class="badge bg-danger">2</span></div>
          </a>
        </li>
      </ul>
    </div>
    <div id="announcement" role="tabpanel" class="tab-pane fade">
      <ul class="media-list mb-0 fs-12">
        <li class="media">
          <div class="media-left"><i class="ti-bar-chart-alt media-object mo-xs img-circle bg-primary text-center"></i></div>
          <div class="media-body">
            <h6 class="media-heading">Market Trend Data</h6>
            <p class="text-muted mb-0">Mattis nam fringilla dui nostra, ad fames fusce venenatis massa.</p>
          </div>
        </li>
        <li class="media">
          <div class="media-left"><i class="ti-package media-object mo-xs img-circle bg-success text-center"></i></div>
          <div class="media-body">
            <h6 class="media-heading">Change Your Password!</h6>
            <p class="text-muted mb-0">Varius dolor condimentum hendrerit eleifend est urna neque fames faucibus?</p>
          </div>
        </li>
        <li class="media">
          <div class="media-left"><i class="ti-gift media-object mo-xs img-circle bg-warning text-center"></i></div>
          <div class="media-body">
            <h6 class="media-heading">We Apologize</h6>
            <p class="text-muted mb-0">Justo at mauris ridiculus conubia penatibus dis varius proin porttitor!</p>
          </div>
        </li>
        <li class="media">
          <div class="media-left"><i class="ti-harddrives media-object mo-xs img-circle bg-info text-center"></i></div>
          <div class="media-body">
            <h6 class="media-heading">Content Policy Update</h6>
            <p class="text-muted mb-0">Quis ante imperdiet a volutpat quam tellus condimentum blandit elementum.</p>
          </div>
        </li>
        <li class="media">
          <div class="media-left"><i class="ti-mobile media-object mo-xs img-circle bg-purple text-center"></i></div>
          <div class="media-body">
            <h6 class="media-heading">Mobile Apps</h6>
            <p class="text-muted mb-0">Ad iaculis at feugiat integer lobortis vivamus hac egestas venenatis.</p>
          </div>
        </li>
        <li class="media">
          <div class="media-left"><i class="ti-alarm-clock media-object mo-xs img-circle bg-danger text-center"></i></div>
          <div class="media-body">
            <h6 class="media-heading">New Features</h6>
            <p class="text-muted mb-0">Primis elementum facilisi tristique faucibus feugiat enim rutrum id himenaeos.</p>
          </div>
        </li>
      </ul>
    </div>
    <div id="ticket" role="tabpanel" class="tab-pane fade">
      <form>
        <div class="form-group">
          <input type="text" placeholder="Username" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Email" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Subject" class="form-control">
        </div>
        <div class="form-group">
          <textarea rows="6" placeholder="Description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-block btn-success">Create Ticket</button>
      </form>
    </div>
    <div id="setting" role="tabpanel" class="tab-pane fade">
      <form class="form-horizontal fs-12">
        <div class="clearfix">
          <h6 class="pull-left">Maintenance Mode</h6>
          <div class="switch pull-right">
            <input id="setting-1" type="checkbox" checked="">
            <label for="setting-1" class="switch-success"></label>
          </div>
        </div>
        <p class="text-muted">Ipsum non tempor non nullam nisi congue nisi amet enim.</p>
        <div class="clearfix">
          <h6 class="pull-left">Location Services</h6>
          <div class="switch pull-right">
            <input id="setting-2" type="checkbox" checked="">
            <label for="setting-2" class="switch-success"></label>
          </div>
        </div>
        <p class="text-muted">Eleifend suscipit erat cursus viverra commodo nostra sit commodo mollis.</p>
        <div class="clearfix">
          <h6 class="pull-left">Display Errors</h6>
          <div class="switch pull-right">
            <input id="setting-3" type="checkbox" checked="">
            <label for="setting-3" class="switch-success"></label>
          </div>
        </div>
        <p class="text-muted">Amet per tortor adipiscing risus dolor orci diam curabitur senectus.</p>
        <div class="clearfix">
          <h6 class="pull-left">Use SEO URLs</h6>
          <div class="switch pull-right">
            <input id="setting-4" type="checkbox" checked="">
            <label for="setting-4" class="switch-success"></label>
          </div>
        </div>
        <p class="text-muted">Ullamcorper dignissim facilisis fames proin a leo diam amet urna.</p>
        <div class="clearfix">
          <h6 class="pull-left">Enable History</h6>
          <div class="switch pull-right">
            <input id="setting-5" type="checkbox" checked="">
            <label for="setting-5" class="switch-success"></label>
          </div>
        </div>
        <p class="text-muted">Consectetur cubilia varius vulputate fermentum non dolor cubilia torquent risus.</p>
      </form>
    </div>
  </div>
</aside>
<aside class="conversation closed">
  <h5 class="text-center m-0 p-20">Edward Garcia<a href="javascript:;" class="conversation-toggle pull-left"><i class="ti-arrow-left text-muted"></i></a><a href="javascript:;" class="pull-right"><i class="ti-pencil text-muted"></i></a></h5>
  <ul data-mcs-theme="minimal-dark" class="media-list chat-content fs-12 pl-20 pr-20 mCustomScrollbar">
    <li class="media">
      <div class="media-left avatar"><img src="{{ URL::to('src/images/04.jpg') }}" alt="" class="media-object img-circle">
        <span class="status bg-success"></span>
      </div>
      <div class="media-body">
        <p>Hello.</p>
        <time datetime="2015-12-10T20:50:48+07:00" class="fs-11 text-muted">09:45 PM <i class="ti-check text-success"></i></time>
      </div>
    </li>
    <li class="media other">
      <div class="media-body">
        <p>Hi.</p>
        <time datetime="2015-12-10T20:50:48+07:00" class="fs-11 text-muted pull-right">09:46 PM <i class="ti-check text-success"></i></time>
      </div>
      <div class="media-right avatar"><img src="{{ URL::to('src/images/04.jpg') }}" alt="" class="media-object img-circle"><span class="status bg-success"></span></div>
    </li>
    <li class="media">
      <div class="media-left avatar"><img src="{{ URL::to('src/img/logo-andalas.png') }}" alt="" class="media-object img-circle"><span class="status bg-success"></span></div>
      <div class="media-body">
        <p>How are you?</p>
        <time datetime="2015-12-10T20:50:48+07:00" class="fs-11 text-muted">09:47 PM <i class="ti-check text-success"></i></time>
      </div>
    </li>
    <li class="media other">
      <div class="media-body">
        <p>I'm good. How are you?</p>
        <time datetime="2015-12-10T20:50:48+07:00" class="fs-11 text-muted pull-right">09:50 PM <i class="ti-check text-success"></i></time>
      </div>
      <div class="media-right avatar"><img src="{{ URL::to('src/images/04.jpg') }}" alt="" class="media-object img-circle"><span class="status bg-success"></span></div>
    </li>
    <li class="media">
      <div class="media-left avatar"><img src="{{ URL::to('src/img/logo-andalas.png') }}" alt="" class="media-object img-circle"><span class="status bg-success"></span></div>
      <div class="media-body">
        <p>Good. Do you speak English?</p>
        <time datetime="2015-12-10T20:50:48+07:00" class="fs-11 text-muted">09:55 PM <i class="ti-check text-success"></i></time>
      </div>
    </li>
  </ul>
  <form class="pl-20 pr-20">
    <div class="form-group has-feedback mb-0">
      <input type="text" aria-describedby="inputSendMessage" placeholder="Sent a message" class="form-control rounded"><span aria-hidden="true" class="ti-pencil-alt form-control-feedback"></span><span id="inputSendMessage" class="sr-only">(default)</span>
    </div>
  </form>
</aside>
<!-- Right Sidebar end-->
