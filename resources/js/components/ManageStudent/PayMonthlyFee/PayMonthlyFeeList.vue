
<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pay Monthly Fee</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->

        <div class="row">
          <div class="col-md-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Student</h3>
                <div>
                  <router-link :to="{name:'studentlist'}" class="btn btn-danger float-right">Back</router-link>
                </div>
              </div>
              <div class="card-body">
                <form @submit.prevent="SearchMonthlyFee">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group mb-5">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Year</span>
                        </div>
                        <select class="form-control" v-model="search.year_id">
                          <option value="">Select year</option>
                          <option v-for="year in years" :key="year.id" :value="year.id">{{ year.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->

                    <div class="col-md-3">
                      <div class="input-group mb-5">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Month</span>
                        </div>
                        <select class="form-control" v-model="search.month_id">
                          <option value="">Select month</option>
                          <option v-for="month in months" :key="month.id" :value="month.id">{{ month.name }}</option>
                        </select>
                      </div>
                    </div> <!-- End Col -->

                    <div class="col-md-3">
                      <div class="input-group mb-5">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Class</span>
                        </div>
                        <select class="form-control" v-model="search.class_id">
                          <option value="">Select Class</option>
                          <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                        </select>
                      </div>
                    </div> <!-- End Col -->

                    <div class="col-md-3">
                      <button type="submit" class="btn btn-primary">Search</button>

                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->
                </form>
              </div>

              <!-- /.card-body -->
            </div>
          </div>

        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">

        <div class="card">
          <div class="card-header">
            <h2 class="text-center">Student List</h2>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Year</th>
                <th>Class</th>
                <th>Group</th>
                <th>Shift</th>
                <th>Monthly Fee</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(student, index) in students" :key="index">
                <td>{{ student.student.id_number}}</td>
                <td>{{ student.student.name}}</td>
                <td>{{ student.year.name}}</td>
                <td>{{ student.student_class.name}}</td>
                <td>{{ student.group.name }}</td>
                <td>{{ student.shift.name }}</td>
                <td>{{ monthly_fee}} Tk</td>

<!--                <td><RouterLink :to="{name:'payregifeeslip', params:{year:student.year_id, class: student.class_id, student:student.student_id}}" class="btn btn-primary">Pay</RouterLink></td>-->

              </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-center">
            <!--              <button class="btn btn-primary" type="submit">Roll Generate</button>-->
          </div>
        </div>



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>



export default {
  name: "PayRegistrationFeeList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getyear();
    this.getMonth();


  },
  computed:{

  },
  data(){
    return {
      search:{
        class_id: '',
        year_id: '',
        month_id: ''
      },
      students: [],
      monthly_fee: '',

      years: [],
      classes: [],
      months: [],
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Pay Registration Fee'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getClass(){
      axios.get('/class').then(res => this.classes = res.data)
    },
    getyear(){
      axios.get('/year').then(res => this.years = res.data)
    },
    getMonth(){
      axios.get('/month').then(res => this.months = res.data)
    },
    SearchMonthlyFee(){
      if (!this.validateData()){
        axios.post('/monthlyfeepay', this.search)
            .then(response => {
              this.students = response.data.students;
              this.monthly_fee = response.data.monthly_fee.amount;

              // console.log(this.students)
            }).catch(error => {
        })
      }
    },


    validateData(){
      if (this.search.year_id.length === 0 || this.search.class_id.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>