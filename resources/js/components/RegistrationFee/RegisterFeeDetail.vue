<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registration Fee Details</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
                <!--                <h2 class="text-center">{{ assignSubjects[0].student_class.name }}</h2>-->
                <h2 class="text-center">{{ year }}</h2>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-striped text-center">
                      <tr v-for="(className, index) in classNames" :key="index">
                        <td>{{ className.student_class.name }}</td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-striped text-center">
                      <tr v-for="(value, index) in amount" :key="index">
                        <td>{{ value.amount }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <router-link :to="{name:'regifee'}" class="btn btn-danger">Back</router-link>
              </div>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


import axios from "axios";

export default {
  name: "RegisterFeeDetail",
  created() {
    this.getDetailById();
  },

  data(){
    return {
      year: '',
      amount: [],
      classNames: []
    }
  },
  methods:{

    pageTitle(){
      document.title = 'Register Fee Detail'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getDetailById(){
      axios.get('/regifee/'+this.$route.params.id)
          .then(res => {
            this.year = res.data[0].year.name
            this.classNames = res.data
            this.amount = res.data
          })
    }

  } // End Method
}
</script>

<style scoped>

</style>