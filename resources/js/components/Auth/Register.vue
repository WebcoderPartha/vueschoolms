<template>
  <div class="register-page">
    <div class="register-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <h1 class="h1">SCHOOL MS</h1>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Register a new membership</p>

          <form @submit.prevent="storeData">
            <div class="input-group mb-3">
              <input type="text" v-model="form.name" class="form-control" placeholder="Full name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>
            </div>
            <div class="input-group mb-3">
              <input type="email" v-model="form.email"  class="form-control" placeholder="Email">
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
            <small class="text-red" v-if="errors.password">{{ errors.password[0]}}</small>
            <div class="input-group mb-3">
              <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <small class="text-red" v-if="errors.password_confirmation">{{ errors.password_confirmation[0]}}</small>

            <div class="row">

              <!-- /.col -->
              <div class="col-4 mx-auto">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

         <div class="text-center mt-2"> <RouterLink :to="{name:'login'}" class="text-center">I already have a membership</RouterLink></div>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
  </div>
</template>

<script>
import axios from "axios";
import resize from "../../../../public/backend/plugins/uplot/uPlot.esm";

export default {
  name: "Register",
  created() {
    this.pageTitle();
    this.authenticate();
  },
  data(){
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors: []
    }
  },
  methods: {
    pageTitle(){
      document.title = 'Register Page'
    },
    authenticate(){
      if (User.authenticate()){
        this.$router.push({name:'dashboard'})
      }
    },
    storeData(){
      if (!this.validateData()){
        axios.post('/auth/register', this.form)
            .then(response => {
              User.responseAfterLogin(response.data.access_token, response.data.user_id)
              // this.$router.push({name: 'dashboard'})
              Notification.success('Register successfully!')
              window.location.href = '/dashboard'
            }).catch(error =>{
          this.errors = error.response.data.errors
        })
      }
    },

    validateData(){
      if (!this.form.name.length > 0){
        Notification.warning('Name is required!')
        return true
      }else if (!this.form.email.length > 0){
        Notification.warning('Email is required!')
        return true
      }else if (!this.form.password.length > 0){
        Notification.warning('Password is required!')
        return true
      }else if (!this.form.password_confirmation.length > 0){
        Notification.warning('Confirm password is required!')
        return true
      }

    }


  },

}
</script>

<style scoped>

</style>