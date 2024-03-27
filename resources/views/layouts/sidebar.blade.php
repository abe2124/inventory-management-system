<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">

                <div class="navbar-nav w-100">
                    <a href="{{ route('admin') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Categories</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('c') }}" class="dropdown-item">All Categories</a>
                            <a href="{{ route('categories.create') }}" class="dropdown-item">Add New Categorie</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="{{ route('item') }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Items</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('item') }}" class="dropdown-item">All Items</a>
                            <a href="{{ route('item.create') }}" class="dropdown-item">Add New Item </a>
                        </div>
                    </div>
                     <div class="nav-item dropdown">
                        <a href="{{ route('purchase') }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Purchase</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('purchase') }}" class="dropdown-item">purchase Items</a>
                            <a href="{{ route('purchases.create') }}" class="dropdown-item">New purchase </a>
                        </div>
                    </div>
                    <a href="{{ route('order.index') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Orders</a>
                    <a href="{{ route('stock.index') }}" class="nav-item nav-link"><i class='fas fa-chart-line' ></i>Stock</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Reports</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </div>
