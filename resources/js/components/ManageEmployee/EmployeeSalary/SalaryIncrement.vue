<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Salary</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <form @submit.prevent="storeData">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="text-center">Increment Salary</h3>
                  <h4 class="text-center">ID: {{form.id_number}}</h4>
                </div>
                <div class="card-body">

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Name</span>
                        </div>
                        <input type="text" disabled v-model="form.name" class="form-control" placeholder="Name">
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Increment Salary</span>
                        </div>
                        <input type="text" v-model="increment.increment_salary"  class="form-control" placeholder="Increment Amount">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Date</span>
                        </div>
                        <input v-model="increment.increment_salary_date" type="date" class="form-control" >
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->



                  <div class="">
                    <button type="submit" class="btn btn-primary">Increment Salary</button>
                    <router-link :to="{name:'salary'}" class="btn btn-danger float-right">Back</router-link>
                  </div>

                </div>

                <!-- /.card-body -->
              </div>
            </div>

          </div>
        </form>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>



export default {
  name: "SalaryIncrment",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getEmployee();

  },
  computed:{

  },
  data(){
    return {
      form: {
      },
      increment: {
        increment_salary: '',
        increment_salary_date: ''
      },
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Add Student'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getEmployee(){
      axios.get('/employee/'+this.$route.params.id).then(res => this.form = res.data)
    },

    storeData(){

      if (!this.validateData()){
        axios.post('/incmentsalary/'+this.$route.params.id, this.increment)
            .then(response => {
              this.$router.push({name: 'salary'})
              Notification.success(response.data);
            }).catch(error => {
          this.errors = error.response.data.errors
        })
      }

    },

    validateData(){
      if (this.increment.increment_salary.length === 0 || this.increment.increment_salary_date.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>