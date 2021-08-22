    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="/"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                        </ul>
                        <!--/.widget-nav-->


                        <ul class="widget widget-menu unstyled">
                            <li><a href="{{ route('quiz.index') }}"><i class="menu-icon icon-inbox"></i>View Quiz <b
                                        class="label green pull-right">
                                        {{ App\Models\Quiz::count() }}</b> </a></li>
                            <li><a href="{{ route('quiz.create') }}"><i class="menu-icon icon-book"></i>Create Quiz </a>
                            </li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="{{ route('question.index') }}"><i class="menu-icon icon-inbox"></i>View
                                    Question <b class="label green pull-right">
                                        {{ App\Models\Question::count() }}</b> </a></li>
                            <li><a href="{{ route('question.create') }}"><i class="menu-icon icon-book"></i>Create
                                    Question
                                </a>
                            </li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="{{ route('user.index') }}"><i class="menu-icon icon-inbox"></i>View
                                    User <b class="label green pull-right">
                                        {{ App\Models\User::count() }}</b> </a></li>
                            <li><a href="{{ route('user.create') }}"><i class="menu-icon icon-book"></i>Create
                                    User
                                </a>
                            </li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="{{ route('assign.userexam') }}"><i class="menu-icon icon-inbox"></i>Assign Exam
                                </a>
                            </li>
                            <li><a href="{{ route('view.exam') }}"><i class="menu-icon icon-book"></i>View User Exam
                                </a>
                            </li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="{{ route('result') }}"><i class="menu-icon icon-inbox"></i>View Result
                                </a>
                            </li>
                        </ul>
                        <!--/.widget-nav-->
                        <ul class="widget widget-menu unstyled">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="menu-icon icon-signout"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->