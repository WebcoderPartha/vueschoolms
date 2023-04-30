<template>
  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <h1 class="h1"><b>SCHOOL MS</b></h1>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form @submit.prevent="login">
            <div class="input-group mb-3">
              <input v-model="form.email" type="email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <small class="text-red" v-if="errors.email">{{ errors.email[0]}}</small>
            <div class="input-group mb-3">
              <input type="password" v-model="form.password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-4 mx-auto">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-0 text-center mt-3">
            <RouterLink :to="{name: 'register'}" class="text-white">Register a new membership</RouterLink>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  created() {
    this.pageTitle();
    this.authenticate();
  },
  data(){
    return {
      form: {
        email: '',
        password: ''
      },
      errors: []
    }
  },
  methods: {
    pageTitle(){
      document.title = 'Login Page'
    },
    authenticate(){
      if (User.authenticate()){
        this.$router.push({name:'dashboard'})
      }
    },
    login(){
      if (!this.validateData()){
        axios.post('/auth/login', this.form)
            .then(response => {
              User.responseAfterLogin(response.data.access_token, response.data.user_id)
              // this.$router.push({name: 'dashboard'})
              Notification.success('Login successfully!')
              window.location.href = '/dashboard'
            }).catch(error =>{
          this.errors = error.response.data.errors
        })
      }
    },

    validateData(){
      if (!this.form.email.length > 0){
        Notification.warning('Email is required!')
        return true
      }else if (!this.form.password.length > 0){
        Notification.warning('Password is required!')
        return true
      }
    }

  }
}
</script>

<style scoped>

</style>