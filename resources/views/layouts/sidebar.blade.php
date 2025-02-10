<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{url('/')}}">Nutra-Med</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">N-M</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->is('dashboard') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class={{ request()->is('/')? 'active' : ''}}><a class="nav-link" href="{{ url('/')}}">General
                            Dashboard</a></li>


                    {{-- <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li> --}}
                </ul>
            </li>


            @canany(['Customer-create', 'Customer-read', 'Customer-update','Customer-delete','PackagingOrder-create',
            'PackagingOrder-read', 'PackagingOrder-update'])

            <li class="menu-header">Starter</li>

            @canany(['Customer-create', 'Customer-read', 'Customer-update','Customer-delete'])
            <li
                class="dropdown {{ request()->routeIs('newCustomerForm','customer.index','customer.edit','upload.customer.excel') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Customer </span></a>
                <ul class="dropdown-menu">
                    @can('Customer-create')
                    <li class="{{ request()->routeIs('newCustomerForm') ? 'active' : ''}}"><a class="nav-link"
                            href="{{route('newCustomerForm')}}">New Customer </a></li>
                    @endcan

                    @can('Customer-read')
                    <li class="{{ request()->routeIs('customer.index','customer.edit') ? 'active' : ''}}"><a
                            class="nav-link" href="{{route('customer.index')}}">Customer List </a></li>
                    @endcan
                    @can('Customer-create')
                    <li class="{{ request()->routeIs('upload.customer.excel') ? 'active' : ''}}"><a class="nav-link"
                            href="{{route('upload.customer.excel')}}">Upload Customer </a></li>
                    @endcan

                </ul>
            </li>
            @endcan

            @canany(['PackagingOrder-create', 'PackagingOrder-read', 'PackagingOrder-update'])
            <li class="dropdown {{ request()->routeIs('newPackagingOrderForm','viewPackaginingOrders','uploadOrderRecordForm',
               'searchPackagingOrder' ,'EditPackagingOrder','viewDuplicatePackagingOrder') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Packaging Order</span></a>
                <ul class="dropdown-menu">

                    @can('PackagingOrder-create')
                    <li class="{{ request()->routeIs('newPackagingOrderForm') ? 'active' : ''}}"><a class="nav-link"
                            href="{{route('newPackagingOrderForm')}}">New Order</a></li>
                    @endcan

                    @can('PackagingOrder-update')
                    <li class="{{ request()->routeIs('searchPackagingOrder','EditPackagingOrder') ? 'active' : ''}}"><a
                            class="nav-link" href="{{route('searchPackagingOrder')}}"> Update Order</a></li>
                    @endcan


                    @can('PackagingOrder-read')
                    <li class="{{ request()->routeIs('viewPackaginingOrders') ? 'active' : ''}}"><a class="nav-link"
                            href="{{ route('viewPackaginingOrders')}}">Master Batch Record </a></li>
                    @endcan

                    @can('DuplicatePackagingOrder-read')
                    <li class="{{ request()->routeIs('viewDuplicatePackagingOrder') ? 'active' : ''}}"><a
                            class="nav-link" href="{{ route('viewDuplicatePackagingOrder')}}">Duplicate Batch Record
                        </a></li>
                    @endcan

                    @can('PackagingOrder-create')
                    <li class="{{ request()->routeIs('uploadOrderRecordForm') ? 'active' : ''}}"><a class="nav-link"
                            href="{{route('uploadOrderRecordForm')}}">Upload Order</a></li>
                    @endcan

                </ul>
            </li>
            @endcan
            @endcan





            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                    <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                    <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                    <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                    <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                    <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                    <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                    <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                    <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                    <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                    <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                    <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                    <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                    <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                    <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                    <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                    <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                    <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                    <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                    <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
                </ul>
            </li> --}}



            @canany(['Search-change_Control_Form','Default-audit','Default-SearchForms','Default-ofrmCreateOrders'])
            <li class="menu-header">Forms</li>

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="components-article.html">Article</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-avatar.html">Avatar</a></li>
                    <li><a class="nav-link" href="components-chat-box.html">Chat Box</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-empty-state.html">Empty State</a></li>
                    <li><a class="nav-link" href="components-gallery.html">Gallery</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-hero.html">Hero</a></li>
                    <li><a class="nav-link" href="components-multiple-upload.html">Multiple Upload</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-pricing.html">Pricing</a></li>
                    <li><a class="nav-link" href="components-statistic.html">Statistic</a></li>
                    <li><a class="nav-link" href="components-tab.html">Tab</a></li>
                    <li><a class="nav-link" href="components-table.html">Table</a></li>
                    <li><a class="nav-link" href="components-user.html">User</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-wizard.html">Wizard</a></li>
                </ul>
            </li> --}}


            @canany(['Search-change_Control_Form', 'Default-audit'])
            <li
                class="dropdown {{ request()->routeIs('changeControlForm','chnageControlePackagingOrder','AuditLogReport','generateAuditReport') ? 'active' :'' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Audit</span></a>

                @can('Search-change_Control_Form')
                <ul class="dropdown-menu">
                    <li
                        class="{{ request()->routeIs('changeControlForm','chnageControlePackagingOrder')? 'active' : ''}}">
                        <a class="nav-link" href="{{route('changeControlForm')}}">Change Control Form</a>
                    </li>
                </ul>
                @endcan

                @can('Default-audit')
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('AuditLogReport','generateAuditReport')? 'active' : ''}}">
                        <a class="nav-link" href="{{route('AuditLogReport')}}">Audit Log Report</a>
                    </li>
                </ul>
                @endcan

            </li>
            @endcan


            @canany(['Default-SearchForms'])

            <li
                class="dropdown {{ request()->routeIs('printOrder','searchPrintOrder','inspection2-3-5','materialTransfer4','materialTranfer4Print'
                ,'materialTransfer4.1','inspection6-8-10','inspection_6_8_10_Print','inspection11-12','inspection11_12_Print',
                'inspection_7_13','inspection_7_13_print','inspection_scale_weight_printed','a_Inspection','b_material_warehouse','b_material_warehouse_print',
                'visionSetupChallenge','warehouseMaterial','productSpecification','searchDuplicatePackagingOrder','EditDuplicatePackagingOrder','printAllForms','PrintAllFormsFetch') ? 'active' :'' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Search Forms</span></a>
                <ul class="dropdown-menu">
                    @can('PackagingOrder-read')
                    <li class="{{ request()->routeIs('printOrder','searchPrintOrder') ? 'active' : ''}}"><a
                            class="nav-link" href="{{route('printOrder')}}">Packaging Order </a></li>
                    @endcan

                    <li class="{{ request()->routeIs('inspection2-3-5',) ? 'active' : ''}}"><a class="nav-link"
                            href="{{route('inspection2-3-5')}}">Inspection2-3-5 </a></li>

                    <li class="{{ request()->routeIs('materialTransfer4','materialTranfer4Print') ? 'active' : ''}}"><a
                            class="nav-link" href="{{route('materialTransfer4')}}">Material Transfer 4 </a></li>

                    <li class="{{ request()->routeIs('materialTransfer4.1',) ? 'active' : ''}}"><a class="nav-link"
                            href="{{route('materialTransfer4.1')}}">Material Transfer 4.1 </a></li>

                    <li class="{{ request()->routeIs('inspection6-8-10','inspection_6_8_10_Print') ? 'active' : ''}}"><a
                            class="nav-link" href="{{route('inspection6-8-10')}}">Inspection 6-8-10 </a></li>

                    <li class="{{ request()->routeIs('inspection11-12','inspection11_12_Print') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('inspection11-12')}}">Inspection 11-12 line/pallet</a>
                    </li>

                    <li class="{{ request()->routeIs('inspection_scale_weight_printed') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('inspection_scale_weight_printed')}}">Inspection
                            Scale-weight
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('inspection_7_13','inspection_7_13_print') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('inspection_7_13')}}">Inspection 7-13</a>
                    </li>

                    {{-- A-Inspection- RE-inspection/Random sampling --}}
                    <li class="{{ request()->routeIs('a_Inspection') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('a_Inspection')}}"
                            title="A-Inspection- RE-inspection/Random sampling"> A-Inspection</a>
                    </li>

                    <li
                        class="{{ request()->routeIs('b_material_warehouse','b_material_warehouse_print') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('b_material_warehouse')}}"
                            title="B-Material Transfer from Warehouse">
                            B-Material Transfer</a>
                    </li>

                    <li class="{{ request()->routeIs('visionSetupChallenge') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('visionSetupChallenge')}}" title="Vision Setup and Challenge">
                            Vision Setup & Challenge </a>
                    </li>

                    <li class="{{ request()->routeIs('warehouseMaterial') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('warehouseMaterial')}}" title="Vision Setup and Challenge">
                            Warehouse Material </a>
                    </li>

                    <li
                        class="{{ request()->routeIs('searchDuplicatePackagingOrder','EditDuplicatePackagingOrder') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('searchDuplicatePackagingOrder')}}"
                            title="Enter Order Information">
                            Enter Order Information</a>
                    </li>

                    <li class="{{ request()->routeIs('productSpecification') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('productSpecification')}}" title="Vision Setup and Challenge">
                            Product Specification </a>
                    </li>


                    <li class="{{ request()->routeIs('printAllForms','PrintAllFormsFetch') ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('printAllForms')}}" title="Vision Setup and Challenge">
                            Print All Forms </a>
                    </li>


                </ul>
            </li>
            @endcan

            @can('Default-ofrmCreateOrders',)
            <li
                class="dropdown {{ request()->routeIs('OfrmCreateOrders','TemplateSubmit','saveNewTemplateRecord') ? 'active' :'' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>OfrmCreateOrders</span></a>
                <ul class="dropdown-menu">
                    <li
                        class="{{ request()->routeIs('OfrmCreateOrders','TemplateSubmit','saveNewTemplateRecord')? 'active' : ''}}">
                        <a class="nav-link" href="{{route('OfrmCreateOrders')}}">OfrmCreateOrders</a>
                    </li>
                </ul>
            </li>
            @endcan

            @endcan
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google
                        Maps</span></a>
                <ul class="dropdown-menu">
                    <li><a href="gmaps-advanced-route.html">Advanced Route</a></li>
                    <li><a href="gmaps-draggable-marker.html">Draggable Marker</a></li>
                    <li><a href="gmaps-geocoding.html">Geocoding</a></li>
                    <li><a href="gmaps-geolocation.html">Geolocation</a></li>
                    <li><a href="gmaps-marker.html">Marker</a></li>
                    <li><a href="gmaps-multiple-marker.html">Multiple Marker</a></li>
                    <li><a href="gmaps-route.html">Route</a></li>
                    <li><a href="gmaps-simple.html">Simple</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="modules-calendar.html">Calendar</a></li>
                    <li><a class="nav-link" href="modules-chartjs.html">ChartJS</a></li>
                    <li><a class="nav-link" href="modules-datatables.html">DataTables</a></li>
                    <li><a class="nav-link" href="modules-flag.html">Flag</a></li>
                    <li><a class="nav-link" href="modules-font-awesome.html">Font Awesome</a></li>
                    <li><a class="nav-link" href="modules-ion-icons.html">Ion Icons</a></li>
                    <li><a class="nav-link" href="modules-owl-carousel.html">Owl Carousel</a></li>
                    <li><a class="nav-link" href="modules-sparkline.html">Sparkline</a></li>
                    <li><a class="nav-link" href="modules-sweet-alert.html">Sweet Alert</a></li>
                    <li><a class="nav-link" href="modules-toastr.html">Toastr</a></li>
                    <li><a class="nav-link" href="modules-vector-map.html">Vector Map</a></li>
                    <li><a class="nav-link" href="modules-weather-icon.html">Weather Icon</a></li>
                </ul>
            </li> --}}




            @canany(['User-create', 'User-read'])
            <li class="menu-header">Auth</li>

            <li class="dropdown   {{ request()->routeIs('register.user','list.user') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                    @can('User-create')
                    <li class="{{ request()->routeIs('register.user') ? 'active' : ''}}"><a
                            href="{{route('register.user')}}">Register New User</a></li>
                    @endcan


                    @can('User-read')
                    <li class="{{ request()->routeIs('list.user') ? 'active' : ''}}"><a
                            href="{{route('list.user')}}">User List</a></li>
                    @endcan

                </ul>
            </li>

            @endcanany

            @role('admin')
            <li
                class="dropdown   {{ request()->routeIs('admin.roles.index','admin.permissions.index','admin.users.index','admin.roles.create','admin.roles.edit','admin.permissions.edit','admin.users.show') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-lock"></i>
                    <span>Roles &
                        Permissions </span></a>
                <ul class="dropdown-menu">
                    <li
                        class="{{ request()->routeIs('admin.roles.index','admin.roles.create','admin.roles.edit') ? 'active' : ''}}">
                        <a href="{{route('admin.roles.index')}}">Roles</a>
                    </li>

                    <li
                        class="{{ request()->routeIs('admin.permissions.index','admin.permissions.edit') ? 'active' : ''}}">
                        <a href="{{route('admin.permissions.index')}}">Permissions</a>
                    </li>

                    <li class="{{ request()->routeIs('admin.users.index','admin.users.show') ? 'active' : ''}}"><a
                            href="{{route('admin.users.index')}}">Users</a></li>

                </ul>
            </li>
            @endrole

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="errors-503.html">503</a></li>
                    <li><a class="nav-link" href="errors-403.html">403</a></li>
                    <li><a class="nav-link" href="errors-404.html">404</a></li>
                    <li><a class="nav-link" href="errors-500.html">500</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="features-activities.html">Activities</a></li>
                    <li><a class="nav-link" href="features-post-create.html">Post Create</a></li>
                    <li><a class="nav-link" href="features-posts.html">Posts</a></li>
                    <li><a class="nav-link" href="features-profile.html">Profile</a></li>
                    <li><a class="nav-link" href="features-settings.html">Settings</a></li>
                    <li><a class="nav-link" href="features-setting-detail.html">Setting Detail</a></li>
                    <li><a class="nav-link" href="features-tickets.html">Tickets</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
                <ul class="dropdown-menu">
                    <li><a href="utilities-contact.html">Contact</a></li>
                    <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
                    <li><a href="utilities-subscribe.html">Subscribe</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a>
            </li> --}}



        </ul>

    </aside>
</div>