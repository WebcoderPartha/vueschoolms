
<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Academic Transcript</h1>
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
          <div class="col-md-12 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Academic Transcript</h3>
                <div>
                  <router-link :to="{name:'dashboard'}" class="btn btn-danger float-right">Back</router-link>
                </div>
              </div>
              <div class="card-body">
                <form @submit.prevent="SearchData">
                  <div class="row">
                    <div class="col-md-2">
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
                          <span class="input-group-text">Class</span>
                        </div>
                        <select class="form-control" v-model="search.class_id">
                          <option value="">Select Class</option>
                          <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                        </select>
                      </div>
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
                          <span class="input-group-text">ID Number</span>
                        </div>
                        <input type="text" class="form-control" placeholder="ID Number" v-model="search.id_number">
                      </div>
                    </div> <!-- End Col -->

                    <div class="col-md-1">
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
            <h2 class="text-center">Academic Transcript</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">

                <table class="table table-bordered" width="100%">
                  <tbody>
                  <tr>
                    <td>Student ID</td>
                    <td><b>{{ student.id_number}}</b></td>
                    <td>Roll Number</td>
                    <td>{{ assign_student.roll_number}}</td>
                  </tr>
                  <tr>
                    <td>Name of Student</td>
                    <td colspan="3"><b>{{ student.name }}</b></td>
                  </tr>
                  <tr>
                    <td>Father's Name</td>
                    <td colspan="3"><b>{{ student.father_name }}</b></td>
                  </tr>
                  <tr>
                    <td>Mother's Name</td>
                    <td colspan="3"><b>{{ student.mother_name }}</b></td>
                  </tr>
                  <tr>
                    <td>Religion</td>
                    <td>{{ student.religion }}</td>
                    <td>Session</td>
                    <td>{{session}}</td>
                  </tr>
                  <tr>
                    <td>Group</td>
                    <td>{{ group_name }}</td>
                    <td>Gender</td>
                    <td>{{ student.gender }}</td>
                  </tr>
                  <tr>
                    <td>Result</td>
                    <td v-if="fail !== 'Fail'">CGPA = <b>{{gradePoint}}</b></td>
                    <td v-else>CGPA = <b>Fail</b></td>
                    <td>Date of Birth</td>
                    <td>{{ student.date_of_birth}}</td>
                  </tr>

                  </tbody>
                </table>
              </div>
              <div class="col-md-4">
                <table class="table table-bordered text-center" width="100%">
                  <thead>
                  <tr>
                    <th>Class Interval</th>
                    <th>Letter Grade</th>
                    <th>Grade Point</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="grade in grades">
                    <td>{{ grade.start_mark }} - {{ grade.end_mark }}</td>
                    <td><span>{{ grade.grade_name }}</span></td>
                    <td>{{ grade.grade_point }}</td>
                  </tr>

                  </tbody>
                </table>
              </div>
            </div> <!-- /Row -->

            <div class="row">
              <div class="col-md-8 mx-auto">
                <h3 class="text-center">Subject-Wise Grade/Marks</h3>
                <table class="table table-bordered text-center" width="100%">
                  <thead class="btn-success">
                  <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Grade Point</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(mark, index) in marks" :key="mark.id">
                    <td class="cent-align">{{ index+1 }}</td>
                    <td class="cent-align">{{ mark.subject.name }}</td>
                    <td class="cent-align">{{ mark.mark }}</td>
                    <td class="cent-align">{{ mark.letter_grade }}</td>

                    <td class="cent-align">{{ mark.grade_point }}</td>
                  </tr>

                  <tr>
                    <td colspan="4" style="border-bottom: none !important;"></td>

                    <td v-if="fail !== 'Fail'"><b>CGPA: {{ gradePoint }}</b></td>
                    <td v-else><b>CGPA: 00</b></td>
                  </tr>


                  </tbody>
                </table>
              </div>
            </div>
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
  name: "PayMonthlyFeeList",
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
        exam_type_id: '',
        id_number: ''
      },
      student: '',
      assign_student: '',
      group_name: '',
      session: '',
      grades: [],
      gradePoint: '',
      marks: [],
      fail: '',


      years: [],
      classes: [],
      exams: [],
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Academic Transcript'
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
    SearchData(){
      if (!this.validateData()){

        axios.post('/searchresult', this.search).then(response => {

          this.student = response.data.student
          this.assign_student = response.data.assign_student
          this.group_name = this.assign_student.group.name
          this.session = this.assign_student.year.name
          this.grades = response.data.grade
          this.fail = response.data.fails

          // CGPA Point
          let totalGradePoint = 0;
          response.data.marks.forEach(item => {
            totalGradePoint += parseFloat(item.grade_point)
          })
          let subjectCount = response.data.marks.length;
          this.gradePoint = parseFloat(totalGradePoint / subjectCount).toFixed(2)
          // End CGPA Point

          this.marks = response.data.marks

          console.log(this.gradePoint)
        }).catch(error => {

        })
      }
    },


    validateData(){
      if (this.search.year_id.length === 0 || this.search.class_id.length === 0 || this.search.exam_type_id.length === 0 || this.search.id_number.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>