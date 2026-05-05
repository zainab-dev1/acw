<div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-right">                 
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    <i class="ti-user" style="margin-right: 8px;"></i>
                                    {{ Auth::user()->fullname }}
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">                   
                                    <div class="dropdown-content-body">
                                        <ul>   
                                            <li>
                                                <a href="#" id="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="ti-power-off"></i> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open(['route'=>'logout','id'=>'logout-form']) }}

{{ Form::close() }}