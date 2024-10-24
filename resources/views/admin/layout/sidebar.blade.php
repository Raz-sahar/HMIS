<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            LHC<span> HMIS</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <!-- <li class="nav-item nav-category">Main</li> -->
            <li class="nav-item">
                <a href=" {{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">General</li>

            <!-- User Accounts Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#user-account" role="button" aria-expanded="false" aria-controls="user-account">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">User Accounts</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="user-account">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Manage Users</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Department Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#department" role="button" aria-expanded="false" aria-controls="department">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Department</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="department">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('general.department') }}" class="nav-link">Manage Department</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Designation Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#designation" role="button" aria-expanded="false" aria-controls="designation">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title">Designation</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="designation">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('general.designation') }}" class="nav-link">Manage Designation</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Employee Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#employee" role="button" aria-expanded="false" aria-controls="employee">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage Employee</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="employee">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Employee Documents</a>
                        </li>
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Employee Shedule</a>
                        </li>
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Doctor Speciality</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Discount Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#discount" role="button" aria-expanded="false" aria-controls="discount">
                    <i class="link-icon" data-feather="percent"></i>
                    <span class="link-title">Manage Discount</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="discount">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Discount Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Discount</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#general-reports" role="button" aria-expanded="false" aria-controls="general-reports">
                    <i class="link-icon" data-feather="bar-chart-2"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="general-reports">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Stock Levels</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Sales Reports</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Reception</li>

            <!-- Patient Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#patient" role="button" aria-expanded="false" aria-controls="patient">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Manage Patient</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="patient">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reception.patient') }}" class="nav-link">Register Patient</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Fees Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#manage-fee" role="button" aria-expanded="false" aria-controls="manage-fee">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Manage Fee</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="manage-fee">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reception.fee') }}" class="nav-link">Fees</a>
                        </li>
                    </ul>
                </div>
            </li>



            <!-- Service Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#service" role="button" aria-expanded="false" aria-controls="service">
                    <i class="link-icon" data-feather="tool"></i>
                    <span class="link-title">Manage Service</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="service">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reception.service-type') }}" class="nav-link">Service Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reception.service') }}" class="nav-link">Service</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Billing/Receipts Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#billing-receipt" role="button" aria-expanded="false" aria-controls="billing-receipt">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">Receipts/Billings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="billing-receipt">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reception.fee.receipt') }}" class="nav-link">Fee Receipt</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reception.service.receipt') }}" class="nav-link">Service Receipt</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reception.invoice.receipt') }}" class="nav-link">Sale Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reception.return.invoice.receipt') }}" class="nav-link">Sale Return</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#reception-reports" role="button" aria-expanded="false" aria-controls="reception-reports">
                    <i class="link-icon" data-feather="bar-chart-2"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="reception-reports">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Stock Levels</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Sales Reports</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Pharmacy</li>

            <!-- pharmacy-general Management -->
            <!-- General -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pharmacy-general" role="button" aria-expanded="false" aria-controls="pharmacy-general">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">General</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="pharmacy-general">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('pharmacy.company') }}" class="nav-link">Company</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pharmacy.supplier') }}" class="nav-link">Supplier</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pharmacy.packing') }}" class="nav-link">Packing</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pharmacy.product') }}" class="nav-link">Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Inventory -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pharmacy-inventory" role="button" aria-expanded="false" aria-controls="pharmacy-inventory">
                    <i class="link-icon" data-feather="archive"></i>
                    <span class="link-title">Inventory</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="pharmacy-inventory">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('pharmacy.stock') }}" class="nav-link">Stock</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pharmacy.purchase') }}" class="nav-link">Purchase</a>
                        </li>

                        <li class="nav-item">
                            <a href="route-name.html" class="nav-link">Purchase Details</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Billings -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pharmacy-billings" role="button" aria-expanded="false" aria-controls="pharmacy-billings">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">Billings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="pharmacy-billings">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="route-name.html" class="nav-link">Sale Invoice</a>
                        </li>

                        <li class="nav-item">
                            <a href="route-name.html" class="nav-link">Invoice Details</a>
                        </li>

                        <li class="nav-item">
                            <a href="route-name.html" class="nav-link">Return Invoice</a>
                        </li>

                        <li class="nav-item">
                            <a href="route-name.html" class="nav-link">Return Details</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pharmacy-reports" role="button" aria-expanded="false" aria-controls="pharmacy-reports">
                    <i class="link-icon" data-feather="bar-chart-2"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="pharmacy-reports">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Stock Levels</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Sales Reports</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Laboratory</li>

            <!-- Test Management -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#test" role="button" aria-expanded="false" aria-controls="test">
                    <i class="link-icon" data-feather="activity"></i>
                    <span class="link-title">Manage Test</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="test">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Test</a>
                        </li>
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Test Referral</a>
                        </li>
                        <li class="nav-item">
                            <a href="route.name.html" class="nav-link">Test Result</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#lab-reports" role="button" aria-expanded="false" aria-controls="lab-reports">
                    <i class="link-icon" data-feather="bar-chart-2"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="lab-reports">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Stock Levels</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Sales Reports</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>