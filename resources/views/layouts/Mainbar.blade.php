<?php
$navs = [
    [
        "label" => "Dashboard",
        "icon" => "fas fa-tachometer-alt",
        "route" => "dashboard",
        "badge" => "",
        "child" => ""
    ],
    [
        "label" => "User",
        "icon" => "far fa-user",
        "route" => "",
        "badge" => "",
        "child" =>[
            [
                "label" => "Admin",
                "icon" => "",
                "route" => "admins.index",
                "badge" => "",
            ],
            [
                "label" => "Rule",
                "icon" => "",
                "route" => "rules.index",
                "badge" => "",
            ],
            [
                "label" => "Permission",
                "icon" => "",
                "route" => "permissions.index",
                "badge" => "",
            ],
            [
                "label" => "Student",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Admission",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Teacher",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Teacher Permission",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Parent",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Accountant",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Librarian",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],

        ]
    ],
    [
        "label" => "Academic",
        "icon" => "fas fa-school",
        "route" => "",
        "child" => [
            [
                "label" => "Daily Class",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Class Routine",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Subject",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Class",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Class Room",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [

                "label" => "Department",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [

                "label" => "Event Calendar",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
        ]
    ],
    [
        "label" => "Exam",
        "icon" => "fas fa-file-alt",
        "badge" => "",
        "route" => "",
        "child" =>[
            [
                "label" => "Mark",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Exam",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Grade",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ],
            [
                "label" => "Promotion",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ]
        ]
    ],
    [
        "label" => "Accounting",
        "icon" => "fas fa-briefcase",
        "route" => "",
        "badge" => "",
        "child" => [
            [
                "label" => "Student fee manager",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ] ,
            [
                "label" => "Expense Category",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ] ,
            [
                "label" => "Expense Manager",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ]
        ]

    ],
    [
        "label" => "Back Office",
        "icon" => "fas fa-laptop-house",
        "route" => "",
        "badge" => "",
        "child" => [
            [
                "label" => "Book List",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ] ,
            [
                "label" => "Book issue report",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ] ,
            [
                "label" => "Noteboard",
                "icon" => "",
                "route" => "",
                "badge" => "",
            ]
        ]

    ],
    [
        "label" => "Setting",
        "icon" => "fas fa-cogs",
        "route" => "",
        "child" => "",
        "badge" => "",
    ]

];

use Illuminate\Support\Facades\Route;
$route=Route::currentRouteName();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{!! asset("assets/admin/dist/img/AdminLTELogo.png") !!}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{!! asset('assets/admin/dist/img/user2-160x160.jpg') !!}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @foreach($navs as $nav)
                    @if($nav['child']=="")
                        <li class="nav-item ">
                            <a href="@if (\Illuminate\Support\Facades\Route::has($nav['route'])) {!! route($nav['route']) !!} @else # @endif" class="nav-link @if($route==$nav['route']) active @endif">
                                <i class="nav-icon @if($nav['icon']!='' ) {!! $nav['icon'] !!} @else fas fa-th @endif"></i>
                                <p>
                                    {!! $nav['label'] !!}
                                    @if($nav['badge']!='' )
                                        <span class="right badge badge-danger">{!! $nav['badge'] !!}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item has-treeview">
                            <a href="@if (\Illuminate\Support\Facades\Route::has($nav['route'])) {!! route($nav['route']) !!} @else # @endif" class="nav-link">
                                <i class="nav-icon @if($nav['icon']!='' ) {!! $nav['icon'] !!} @else fas fa-th @endif"></i>
                                <p>
                                    {!! $nav['label'] !!}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                @foreach($nav['child'] as $item)
                                    @if(is_array($item))
                                    <li class="nav-item ">
                                        <a href="@if (\Illuminate\Support\Facades\Route::has($item['route'])) {!! route($item['route']) !!} @else # @endif" class="nav-link @if($route==$item['route']) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{!! $item['label'] !!} </p>
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                    @endif

                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
