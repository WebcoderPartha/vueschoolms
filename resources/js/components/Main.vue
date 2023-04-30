<template>
  <div class="wrapper">


    <!-- Navbar -->
    <Header></Header>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <MenuBar></MenuBar>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <router-view></router-view>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->


  </div>
</template>

<script>
import Header from "./common/Header.vue";
import MenuBar from "./common/MenuBar.vue";
export default {
  name: "Main",
  components: {
    Header,
    MenuBar
  }
}
</script>

<style scoped>

</style>