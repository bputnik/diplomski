<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Škola: Ars Educa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Komandna tabla</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administracija
    </div>


    <!-- Nav Item - Pages Collapse Menu Students-->
    <li class="nav-item" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents" aria-expanded="true" aria-controls="collapseStudents">
            <i class="fas fa-fw fa-cog"></i>
            <span>Polaznici</span>
        </a>
        <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item" href="{{route('admin.students.create')}}" >Kreiranje novog profila</a>
                <a class="collapse-item" href="{{route('admin.students.show')}}">Pregled, izmena, brisanje</a>
                <a class="collapse-item" href="{{route('admin.trustees.show')}}">Roditelji / staraoci</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu TEACHERS-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeachers" aria-expanded="true" aria-controls="collapseTeachers">
            <i class="fas fa-fw fa-cog"></i>
            <span>Profesori</span>
        </a>
        <div id="collapseTeachers" class="collapse" aria-labelledby="headingTeachers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
{{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item" href="{{route('admin.teachers.create')}}">Kreiranje novog profila</a>
                <a class="collapse-item" href="{{route('admin.teachers.show')}}">Pregled, izmena, brisanje</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Pages Collapse Menu GROUPS-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroups" aria-expanded="true" aria-controls="collapseGroups">
            <i class="fas fa-fw fa-cog"></i>
            <span>Grupe</span>
        </a>
        <div id="collapseGroups" class="collapse" aria-labelledby="headingGroups" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item" href="{{route('admin.groups.create')}}">Dodavanje nove grupe</a>
                <a class="collapse-item" href="{{route('admin.groups.show')}}">Pregled, izmena, brisanje</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu COURSES-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourses" aria-expanded="true" aria-controls="collapseCourses">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kursevi</span>
        </a>
        <div id="collapseCourses" class="collapse" aria-labelledby="headingCourses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item" href="{{route('admin.courses.types.index')}}">Vrste kurseva</a>
                <a class="collapse-item" href="{{route('admin.courses.create')}}">Kreiranje novog kursa</a>
                <a class="collapse-item" href="{{route('admin.courses.show')}}">Pregled, izmena, brisanje</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu LANGUAGES -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLanguages" aria-expanded="true" aria-controls="collapseLanguages">
            <i class="fas fa-fw fa-cog"></i>
            <span>Jezici</span>
        </a>
        <div id="collapseLanguages" class="collapse" aria-labelledby="headingLanguages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}

                <a class="collapse-item" href="{{route('admin.languages.index')}}">Pregled svih jezika</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu LANGUAGE LEVELS -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLevels" aria-expanded="true" aria-controls="collapseLevels">
            <i class="fas fa-fw fa-cog"></i>
            <span>Jezički nivoi</span>
        </a>
        <div id="collapseLevels" class="collapse" aria-labelledby="headingLevels" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}

                <a class="collapse-item" href="{{route('admin.levels.create')}}">Kreiranje novog nivoa</a>
                <a class="collapse-item" href="{{route('admin.levels.index')}}">Pregled, izmena, brisanje</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu TEACHING TYPES -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeachingTypes" aria-expanded="true" aria-controls="collapseTeachingTypes">
            <i class="fas fa-fw fa-cog"></i>
            <span>Tipovi nastave</span>
        </a>
        <div id="collapseTeachingTypes" class="collapse" aria-labelledby="headingTeachingTypes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item" href="{{route('admin.teaching-types.index')}}">Pregled tipova nastave</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner  rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item active" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
