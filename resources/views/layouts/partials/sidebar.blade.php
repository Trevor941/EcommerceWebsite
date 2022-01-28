<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><b>E-Website</b></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Product Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productmenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-tshirt"></i>
            <span>Products</span>
        </a>
        <div id="productmenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action</h6>
                <a class="collapse-item" href="{{route('products.index')}}">All Products</a>
                <a class="collapse-item" href="{{route('products.create')}}">Add New</a>
            </div>
        </div>
    </li>

  
    <li class="nav-item">
        <a class="nav-link" href="{{route('categories.index')}}">
            <i class="fas fa-shopping-bag"></i>
            <span> Categories</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('tags.index')}}">
            <i class="fas fa-tags"></i>
            <span> Tags</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Analysis
    </div>

  <!-- Nav Item - Product Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-border-none"></i>
        <span>Orders</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-users"></i>
        <span>Customers</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="far fa-credit-card"></i>
        <span>Coupons</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="far fa-chart-bar"></i>
        <span>Reports</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-user-tie"></i>
        <span>Users</span></a>
</li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Payments
  </div>

<!-- Nav Item - Product Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="#">
    <i>P</i>
      <span>Payfast</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fab fa-stripe"></i>
      <span>Stripe</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fab fa-paypal"></i>
      <span>PayPal</span></a>
</li>

<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    External Data
</div>

<!-- Nav Item - Product Collapse Menu -->
<li class="nav-item">
<a class="nav-link" href="#">
  <i class="fab fa-facebook-square"></i>
    <span>Facebook</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">
  <i class="fab fa-instagram-square"></i>
    <span>Instagram</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">
  <i class="fas fa-chart-pie"></i>
    <span>Google Analytics</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">
  <i class="fas fa-search"></i>
    <span>Google Search Console</span></a>
</li>

    <hr class="sidebar-divider d-none d-md-block">

    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->

</ul>