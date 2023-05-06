<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Exam Fee Pay</h1>
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
                <h3>Exam Fee Pay Slip <RouterLink :to="{name:'payexamfee'}" class="btn btn-primary float-right">Back</RouterLink></h3>
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
                    <td>{{ student.sid}}</td>
                  </tr>
                  <tr>
                    <td>Year </td>
                    <td>{{ student.year}}</td>
                  </tr>
                  <tr>
                    <td>Month: </td>
                    <td>{{ student.exam}}</td>
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
                    <td>Exam Fee: </td>
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
  name: "PayExamFeeSlip",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getStudentExamPay();
  },

  data(){
    return {
      student: '',

    }
  },

  methods:{

    pageTitle(){
      document.title = 'Exam Pay Sleep'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getStudentExamPay(){
      axios.get('/examfeepay/'+this.$route.params.year+'/'+this.$route.params.exam+'/'+this.$route.params.class+'/'+this.$route.params.student).then(response => {
        this.student = {
          name: response.data.students.student.name,
          student_id: response.data.students.student.id,
          sid: response.data.students.student.id_number,
          year: response.data.students.year.name,
          class: response.data.students.student_class.name,
          group: response.data.students.group.name,
          shift: response.data.students.shift.name,
          exam: response.data.exam.exam.name,
          amount: response.data.exam.amount
        }

        // console.log(this.student)
      })
    },



  } // End Method
}
</script>

<style scoped>

</style>