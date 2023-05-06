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


          <li class="nav-item" :class="(this.$route.path === '/classes' || this.$route.path === '/year' || this.$route.path === '/exam/group') ? 'menu-open' : ''">
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
                <RouterLink :to="{name:'group'}" :class="this.$route.path === '/group' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Group</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'shift'}" :class="this.$route.path === '/shift' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Shift</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'examtype'}" class="nav-link" :class="this.$route.path === '/exam/type' ? 'active' : ''">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Exam Type</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'subject'}" class="nav-link" :class="this.$route.path === '/subject' ? 'active' : ''">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Subject</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'assignsubject'}" class="nav-link" :class="this.$route.path === '/assign/subject' ? 'active' : ''">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Assign Subject</p>
                </RouterLink>
              </li>
            </ul>
          </li>


          <li class="nav-item" :class="(this.$route.path === '/registration/fees' || this.$route.path === '/monthly/fees') ? 'menu-open' : ''">
            <a href="#" class="nav-link" :class="(this.$route.path === '/registration/fees' || this.$route.path === '/monthly/fees') ? 'active' : ''">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Manage Fee
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <RouterLink :to="{name:'regifee'}"  :class="this.$route.path === '/registration/fees' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Registration Fee</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'monthlyfee'}"  :class="this.$route.path === '/monthly/fees' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Monthly Fee</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'examfee'}" :class="this.$route.path === '/exam/fees' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Exam Fee</p>
                </RouterLink>
              </li>

            </ul>
          </li>


          <li class="nav-item" :class="(this.$route.path === '/student/view-all') ? 'menu-open' : ''">
            <a href="#" class="nav-link" :class="(this.$route.path === '/student/view-all') ? 'active' : ''">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Manage Student
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <RouterLink :to="{name:'studentlist'}"  :class="this.$route.path === '/student/view-all' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Register Student</p>
                </RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :to="{name:'rollgenerate'}"  :class="this.$route.path === '/roll/generate' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Roll Generate</p>
                </RouterLink>
              </li>

              <li class="nav-item">
                <RouterLink :to="{name:'payregifee'}"  :class="this.$route.path === '/pay/registration/fee' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Pay Registration Fee</p>
                </RouterLink>
              </li>

              <li class="nav-item">
                <RouterLink :to="{name:'paymonthlyfee'}"  :class="this.$route.path === '/pay/monthly/fee' ? 'active' : ''" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Pay Monthly Fee</p>
                </RouterLink>
              </li>

              <li class="nav-item">
              <RouterLink :to="{name:'payexamfee'}"  :class="this.$route.path === '/pay/exam/fee' ? 'active' : ''" class="nav-link">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Pay Monthly Fee</p>
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