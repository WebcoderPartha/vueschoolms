<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registration Fee Pay</h1>
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
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3>Monthly Fee Pay Slip <RouterLink :to="{name:'paymonthlyfee'}" class="btn btn-primary float-right">Back</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tr>
                    <td>Name: </td>
                    <td>{{ student.name}}</td>
                  </tr>
                  <tr>
                    <td>Student ID: </td>
                    <td>{{ student.std}}</td>
                  </tr>
                  <tr>
                    <td>Year </td>
                    <td>{{ student.year}}</td>
                  </tr>
                  <tr>
                    <td>Month: </td>
                    <td>{{ student.month}}</td>
                  </tr>
                  <tr>
                    <td>Class: </td>
                    <td>{{ student.class}}</td>
                  </tr>
                  <tr>
                    <td>Group: </td>
                    <td>{{ student.group}}</td>
                  </tr>
                  <tr>
                    <td>Monthly Fee: </td>
                    <td>{{ student.amount }}</td>
                  </tr>


                </table>
              </div>
              <!-- /.card-body -->

            </div>


          </div>


        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "PayMonthlyFeeSlip",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getStudentMonthlyPay();
  },

  data(){
    return {
      student: '',

    }
  },

  methods:{

    pageTitle(){
      document.title = 'Monthly Pay Sleep'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getStudentMonthlyPay(){
      axios.get('/monthlyfeepay/'+this.$route.params.year+'/'+this.$route.params.month+'/'+this.$route.params.class+'/'+this.$route.params.student).then(response => {
        this.student = {
          name: response.data.students.student.name,
          year: response.data.students.year.name,
          std: response.data.students.student.id_number,
          group: response.data.students.group.name,
          class: response.data.students.student_class.name,
          month: response.data.monthly_fee.month.name,
          amount: response.data.monthly_fee.amount
        }

        // console.log(this.student)
      })
    },



  } // End Method
}
</script>

<style scoped>

</style>