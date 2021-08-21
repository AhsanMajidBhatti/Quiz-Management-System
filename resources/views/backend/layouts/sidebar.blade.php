    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="/adminpage"><i class="menu-icon icon-dashboard"></i>Dashboard
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
                        <!--/.widget-nav-->
                        <ul class="widget widget-menu unstyled">
                            <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i
                                        class="menu-icon icon-cog">
                                    </i><i class="icon-chevron-down pull-right"></i><i
                                        class="icon-chevron-up pull-right">
                                    </i>More Pages </a>
                                <ul id="togglePages" class="collapse unstyled">
                                    <li><a href="other-login.html"><i class="icon-inbox"></i>Login </a></li>
                                    <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Profile </a></li>
                                    <li><a href="other-user-listing.html"><i class="icon-inbox"></i>All Users </a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="menu-icon icon-signout"></i>Logout </a></li>
                        </ul>
                    </div>
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->