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
                <h3>Registration Fee Pay Slip <RouterLink :to="{name:'payregifee'}" class="btn btn-primary float-right">Back</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tr>
                    <td>Name: </td>
                    <td>{{ student.name}}</td>
                  </tr>
                  <tr>
                    <td>Year: </td>
                    <td>{{ student.year}}</td>
                  </tr>
                  <tr>
                    <td>Class: </td>
                    <td>{{ student.class}}</td>
                  </tr>
                  <tr>
                    <td>Registration Fee: </td>
                    <td>{{ student.regifee_amount}}</td>
                  </tr>
                  <tr>
                    <td>Discount: </td>
                    <td>{{ student.discount}}</td>
                  </tr>
                  <tr>
                    <td>Final Fee: </td>
                    <td>{{ student.final_amount}}</td>
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
  name: "PayRegistrationFeeSlip",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getStudentRegiPay();
  },

  data(){
    return {

      student: ''

    }
  },

  methods:{

    pageTitle(){
      document.title = 'Registration Pay Sleep'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getStudentRegiPay(){
      axios.get('/regifeepay/'+this.$route.params.year+'/'+this.$route.params.class+'/'+this.$route.params.student).then(response => {
        let finalAmount = response.data.registration_fee.amount - (response.data.registration_fee.amount*response.data.students.discount_percentage)/100
        this.student = {
          name: response.data.students.student.name,
          year: response.data.students.year.name,
          class: response.data.students.student_class.name,
          regifee_amount: response.data.registration_fee.amount,
          discount: response.data.students.discount_percentage,
          final_amount: finalAmount
        }
        // console.log(this.student)
      })
    },



  } // End Method
}
</script>

<style scoped>

</style>