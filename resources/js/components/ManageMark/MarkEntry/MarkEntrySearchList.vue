
<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mark Entry</h1>
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
                <h3 class="card-title">Search Student</h3>
                <div>
                  <router-link :to="{name:'dashboard'}" class="btn btn-danger float-right">Back</router-link>
                </div>
              </div>
              <div class="card-body">
                <form @submit.prevent="SearchMonthlyFee">
                  <div class="row">
                    <div class="col-md-5">
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

                    <div class="col-md-5">
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


                    <div class="col-md-2">
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
        <form @submit.prevent="storeData" ref="clearDataForm">
        <div class="card" v-if="students.length > 0">
          <div class="card-header">
            <h2 class="text-center">Student List</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-3">
                <div class="input-group mb-5">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Subject</span>
                  </div>
                  <select class="form-control" v-model="subject_id">
                    <option value="">Select subject</option>
                    <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.name }}</option>
                  </select>
                </div>
              </div> <!-- End Col -->

              <div class="col-md-3">
                <div class="input-group mb-5">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Exam</span>
                  </div>
                  <select class="form-control" v-model="exam_type_id">
                    <option value="">Select exam</option>
                    <option v-for="exam in exams" :key="exam.id" :value="exam.id">{{ exam.name }}</option>
                  </select>
                </div>
              </div> <!-- End Col -->
              <div class="col-md-3"></div>
            </div><!-- /Row -->
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Class Roll</th>
                <th>Year</th>
                <th>Class</th>
                <th>Entry Mark</th>

              </tr>
              </thead>
              <tbody>
              <tr v-for="student in students" :key="student.id">
                <td>{{ student.student.id_number}}</td>
                <td>{{ student.student.name}}</td>
                <td>{{ student.roll_number}}</td>
                <td>{{ student.year.name}}</td>
                <td>{{ student.student_class.name}}</td>
                <td width="140px">
                  <input type="text" class="form-control" :data-id="student.student_id" :data-class-id="student.class_id" :data-year-id="student.year_id" placeholder="Enter mark" @change="getMarkEvent">
                </td>



              </tr>
              </tbody>
            </table>

          </div>
          <div class="card-footer text-center">
            <button class="btn btn-primary" type="submit">Mark Entry</button>
          </div>

        </div>
        </form>



      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>



export default {
  name: "MarkEntrySearchList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getyear();
    this.getSubject();
    this.getExam();


  },
  computed:{

  },
  data(){
    return {
      search:{
        class_id: '',
        year_id: '',
      },
      subject_id: '',
      exam_type_id: '',
      storeMark: [],
      students: [],
      years: [],
      classes: [],
      exams: [],
      subjects: [],
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'MarkEntry Search'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getMarkEvent(e){
      if (!this.ValidateMarkBeforeSubjectExam()){
        let data = {
          class_id: e.target.getAttribute('data-class-id'),
          year_id: e.target.getAttribute('data-year-id'),
          subject_id: this.subject_id,
          exam_type_id: this.exam_type_id,
          student_id: e.target.getAttribute('data-id'),
          mark: e.target.value
        }

        this.storeMark.push(data);
        // Unique array
        this.storeMark = [...new Map(this.storeMark.map(item=> [item['student_id'], item])).values() ]
      }
      console.log(this.storeMark);

    },
    getClass(){
      axios.get('/class').then(res => this.classes = res.data)
    },
    getyear(){
      axios.get('/year').then(res => this.years = res.data)
    },
    getSubject(){
      axios.get('/subject').then(res => this.subjects = res.data)
    },
    getExam(){
      axios.get('/examtype').then(res => this.exams = res.data)
    },
    SearchMonthlyFee(){
      if (!this.validateSearch()){
        axios.post('/getmarkstudent', this.search)
            .then(response => {
              this.students = response.data;
            }).catch(error => {
        })
      }
    },

    storeData(){
      if (!this.validateEntryMark()){

        let data = {
          storeMark:this. storeMark
        };
        axios.post('/markstore', data)
            .then(response => {
              this.$router.push({name: 'markentry'})
              this.storeMark = []
              this.$refs.clearDataForm.reset();
              Notification.success(response.data)
            }).catch(error => {
        })
      }
    },
    validateSearch(){
      if (this.search.year_id.length === 0 || this.search.class_id.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    },

    ValidateMarkBeforeSubjectExam(){
      if (this.subject_id.length === 0){
        Notification.error('Subject field must not be empty!')
        return true;
      }else if(this.exam_type_id.length === 0){
        Notification.error('Exam field must not be empty!');
        return true
      }
    },
    validateEntryMark(){
      if (this.search.year_id.length === 0 || this.search.class_id.length === 0 || this.exam_type_id.length === 0 || this.subject_id.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>