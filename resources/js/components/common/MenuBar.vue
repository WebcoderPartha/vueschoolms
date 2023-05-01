<template>
  <aside style="display: none" id="menu_bar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item" :class="this.$route.path === '/dashboard' ? 'menu-open' : ''">
            <router-link :to="{name:'dashboard'}" class="nav-link" :class="this.$route.path === '/dashboard' ? 'active' : ''">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>

          </li>


          <li class="nav-item" :class="this.$route.path === '/classes' ? 'menu-open' : ''">
            <a href="#" class="nav-link" :class="(this.$route.path === '/classes' || this.$route.path === '/year') ? 'active' : ''">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Setup
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <RouterLink :to="{name:'classes'}"  :class="this.$route.path === '/classes' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Classes</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'year'}"  :class="this.$route.path === '/year' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Year</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'classes'}" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Group</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'classes'}" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Shift</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'classes'}" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Exam Type</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'classes'}" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Subject</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'classes'}" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Assign Subject</p>
                </RouterLink>
              </li>
            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  name: "MenuBar"
}
</script>

<style scoped>

</style>