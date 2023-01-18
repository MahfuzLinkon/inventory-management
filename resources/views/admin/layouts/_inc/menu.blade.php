<aside id="sidebar" class="js-custom-scroll side-nav">
    <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
        <!-- Title -->
        <li class="sidebar-heading h6">Dashboard</li>
        <!-- End Title -->

        <!-- Dashboard -->
        <li class="side-nav-menu-item">
            <a class="side-nav-menu-link media align-items-center" href="{{ route('dashboard') }}">
          <span class="side-nav-menu-icon d-flex mr-3">
            <i class="gd-dashboard"></i>
          </span>
                <span class="side-nav-fadeout-on-closed media-body">Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard -->

        <!-- Title -->
        <li class="sidebar-heading h6">Examples</li>
        <!-- End Title -->

        <!-- Users -->
        <li class="side-nav-menu-item side-nav-has-menu">
            <a class="side-nav-menu-link media align-items-center" href="#"
               data-target="#subUsers">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-user"></i>
              </span>
                <span class="side-nav-fadeout-on-closed media-body">Users</span>
                <span class="side-nav-control-icon d-flex">
            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
          </span>
                <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
            </a>

            <!-- Users: subUsers -->
            <ul id="subUsers" class="side-nav-menu side-nav-menu-second-level mb-0">
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="users.html">All Users</a>
                </li>
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="user-edit.html">Add new</a>
                </li>
            </ul>
            <!-- End Users: subUsers -->
        </li>
        <!-- End Users -->

        <!-- Supplier -->
        <li class="side-nav-menu-item side-nav-has-menu">
            <a class="side-nav-menu-link media align-items-center" href="#"
               data-target="#subPages">
          <span class="side-nav-menu-icon d-flex mr-3">
            <i class="gd-shopping-cart"></i>
          </span>
                <span class="side-nav-fadeout-on-closed media-body">Suppliers</span>
                <span class="side-nav-control-icon d-flex">
            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
          </span>
                <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
            </a>

            <!-- Pages: subPages -->
            <ul id="subPages" class="side-nav-menu side-nav-menu-second-level mb-0">
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('suppliers.index') }}">All Suppliers</a>
                </li>
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('suppliers.create') }}">Add New Suppliers</a>
                </li>
            </ul>
            <!-- End Pages: subPages -->
        </li>
        <!-- End Supplier -->

        <!-- Supplier -->
        <li class="side-nav-menu-item side-nav-has-menu">
            <a class="side-nav-menu-link media align-items-center" href="#"
               data-target="#customers">
          <span class="side-nav-menu-icon d-flex mr-3">
            <i class="gd-crown"></i>
          </span>
                <span class="side-nav-fadeout-on-closed media-body">Customers</span>
                <span class="side-nav-control-icon d-flex">
            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
          </span>
                <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
            </a>

            <!-- Pages: subPages -->
            <ul id="customers" class="side-nav-menu side-nav-menu-second-level mb-0">
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('customers.index') }}">All Customers</a>
                </li>
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('customers.create') }}">Add New Customers</a>
                </li>
            </ul>
            <!-- End Pages: subPages -->
        </li>
        <!-- End Supplier -->

        <!-- Units -->
        <li class="side-nav-menu-item side-nav-has-menu">
            <a class="side-nav-menu-link media align-items-center" href="#"
               data-target="#units">
          <span class="side-nav-menu-icon d-flex mr-3">
            <i class="gd-ruler-pencil"></i>
          </span>
                <span class="side-nav-fadeout-on-closed media-body">Units</span>
                <span class="side-nav-control-icon d-flex">
            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
          </span>
                <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
            </a>

            <!-- Pages: subPages -->
            <ul id="units" class="side-nav-menu side-nav-menu-second-level mb-0">
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('units.index') }}">All Units</a>
                </li>
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('units.create') }}">Add New Units</a>
                </li>
            </ul>
            <!-- End Pages: subPages -->
        </li>
        <!-- End Units -->

        <!-- Category -->
        <li class="side-nav-menu-item side-nav-has-menu">
            <a class="side-nav-menu-link media align-items-center" href="#"
               data-target="#category">
          <span class="side-nav-menu-icon d-flex mr-3">
            <i class="gd-server"></i>
          </span>
                <span class="side-nav-fadeout-on-closed media-body">Category</span>
                <span class="side-nav-control-icon d-flex">
            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
          </span>
                <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
            </a>

            <!-- Pages: subPages -->
            <ul id="category" class="side-nav-menu side-nav-menu-second-level mb-0">
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('categories.index') }}">All Category</a>
                </li>
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('categories.create') }}">Add New Category</a>
                </li>
            </ul>
            <!-- End Pages: subPages -->
        </li>
        <!-- End Category -->



        <!-- Products -->
        <li class="side-nav-menu-item side-nav-has-menu">
            <a class="side-nav-menu-link media align-items-center" href="#"
               data-target="#product">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-shopping-cart-full"></i>
              </span>
                <span class="side-nav-fadeout-on-closed media-body">Products</span>
                <span class="side-nav-control-icon d-flex">
            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
          </span>
                <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
            </a>

            <ul id="product" class="side-nav-menu side-nav-menu-second-level mb-0">
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('products.index') }}">All Product</a>
                </li>
                <li class="side-nav-menu-item">
                    <a class="side-nav-menu-link" href="{{ route('products.create') }}">Add New Product</a>
                </li>
            </ul>
        </li>
        <!-- End Products -->


    </ul>
</aside>
