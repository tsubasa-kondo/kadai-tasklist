<header class="mb-4">  
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <a class="navbar-brand" href="/">Microposts</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav mr-auto"></ul>
            　　<ul class="navbar-nav">
            </div>

                <div class="collapse navbar-collapse" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                        @if (Auth::check())
                            <a class="navbar-brand" href="/">tasklist</a>
                        
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-divider"></li>
                                    <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                                </ul>
                            </li>
                        @else
                            
                            
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                                   <span class="navbar-toggler-icon"></span>
                                </button>
                            <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                            <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                        @endif
                    </ul>
                </div>
 
                
                
                
                
            </nav>
        </header>