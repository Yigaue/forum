<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{-- {{ config('app.name', 'Forum') }} --}}
                Forum
            </a>
          
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                        

                        <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                            <li class="nav-item">
                                             <a class="nav-link" href="/threads">All Threads</a>
                                             </li>
                                             @if(auth()->check())
                                            <li class="nav-item">
                                            <a class="nav-link" href="/threads?by={{auth()->user()->name}}">My Threads</a>
                                            </li>
                                            @endif
                                        <li><a class="nav-link" href="/threads?popular=1">Popular Threads</a></li>
                                     </ul>
                            </li>   

                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Channels
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                     @foreach ($channels as $channel)
                                    <li class="text-center"><a href="/threads/{{$channel->slug}}">{{$channel->name}}</a></li>  
                                    @endforeach
                                 </ul>
                        </li>    
                 </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                                <a class="nav-link" href="/threads/create">New Thread</a>
                            </li>
                    <!-- Authentication Links -->
                    @guest
                    
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        {{-- <li class="nav-item dropdown">
                            
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <a class= "dropdown-item" href="{{route('profile', Auth::user())}}">My Profile</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>