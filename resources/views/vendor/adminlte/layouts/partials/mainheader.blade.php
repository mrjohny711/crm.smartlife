<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CRM</b> SmartLife</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/online_users"> {{Activity::users()->count()}} Utilizadores Online</a>
                </li>
                <li>
                    <a href="/human_resources">Recursos Humanos</a>
                </li>
                <li>
                    <a href="/club">Club1970</a>
                </li>
                <li>
                    <a>Contabilidade</a>
                </li>
                <li>
                    <a>Administração</a>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu" id="user_menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->name }}<br>
                                <small>{{ Auth::user()->roles()->first()->display_name}}</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/users/{{Auth::user()->id}}/settings" class="btn btn-default btn-flat">Configurações</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Sair
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="submit" value="logout" style="display: none;">
                                </form>

                            </div>
                        </li>
                    </ul>
                </li>
                <li class="clock" style="margin-right: 10px;">
                    <a style="color: #FFFFFF; pointer-events: none;" id="clock"></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
