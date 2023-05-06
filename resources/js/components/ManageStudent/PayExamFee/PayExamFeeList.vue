
<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pay Exam Fee</h1>
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
                  <router-link :to="{name:'payexamfee'}" class="btn btn-danger float-right">Back</router-link>
                </div>
              </div>
              <div class="card-body">
                <form @submit.prevent="SearchExamFee">
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
                          <span class="input-group-text">Exam</span>
                        </div>
                        <select class="form-control" v-model="search.exam_type_id">
                          <option value="">Select exam</option>
                          <option v-for="exam in exams" :key="exam.id" :value="exam.id">{{ exam.name }}</option>
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
                <th>Exam</th>
                <th>Class</th>
                <th>Group</th>
                <th>Shift</th>
                <th>Exam Fee</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(student, index) in students" :key="index">
                <td>{{ student.sid}}</td>
                <td>{{ student.name}}</td>
                <td>{{ student.year}}</td>
                <td>{{ student.exam}}</td>
                <td>{{ student.class}}</td>
                <td>{{ student.group }}</td>
                <td>{{ student.shift }}</td>
                <td>{{ student.amount}} Tk</td>

                <td><RouterLink :to="{name:'payexamfeeslip', params:{year:student.year_id,exam:student.exam_type_id, class: student.class_id, student:student.student_id}}" class="btn btn-primary">Pay</RouterLink></td>

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
  name: "PayExamFeeList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getyear();
    this.getExam();


  },
  computed:{

  },
  data(){
    return {
      search:{
        class_id: '',
        year_id: '',
        exam_type_id: ''
      },
      students: [],

      years: [],
      classes: [],
      exams: [],
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Pay Exam Fee'
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
    getExam(){
      axios.get('/examtype').then(res => this.exams = res.data)
    },
    SearchExamFee(){
      if (!this.validateData()){
        axios.post('/examfeepay', this.search)
            .then(response => {

              response.data.students.forEach(student => {

                this.students.push({
                  name: student.student.name,
                  student_id: student.student.id,
                  sid: student.student.id_number,
                  year: student.year.name,
                  year_id: student.year.id,
                  class: student.student_class.name,
                  class_id: student.student_class.id,
                  group: student.group.name,
                  shift: student.shift.name,
                  exam: response.data.exam.exam.name,
                  exam_type_id: response.data.exam.exam_type_id,
                  amount: response.data.exam.amount
                })

              })

              // Unique Object Array Passing
              this.students = [...new Map(this.students.map(item => [item['student_id'], item])).values()]

              // console.log(this.students)
            }).catch(error => {
        })
      }
    },


    validateData(){
      if (this.search.year_id.length === 0 || this.search.class_id.length === 0 || this.search.exam_type_id === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>