<template>
  <nav class="main-header navbar navbar-expand navbar-dark" style="display: none" id="top_navbar">
    <!-- Left navbar links -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->



      <li class="nav-item">
        <a @click.prevent="logout" class="nav-link" style="font-size: 20px" data-slide="true" href="#" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Header",
  created() {

  },
  methods: {
    logout(){
      axios.get('/auth/logout').then(res => {
        localStorage.removeItem('token');
        localStorage.removeItem('userid');
        // this.$router.push({name: 'login'})
        window.location.href = '/'
        Notification.success(res.data)
      })
    }
  }
}
</script>

<style scoped>

</style>