
<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Result</h1>
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
                <h3 class="card-title">Search Result</h3>
                <div>
                  <router-link :to="{name:'dashboard'}" class="btn btn-danger float-right">Back</router-link>
                </div>
              </div>
              <div class="card-body">
                <form @submit.prevent="SearchData">
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
            <h2 class="text-center">Results</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <span class="result" v-for="result in results">
                  {{result.id_number}} : <b v-for="fail in fails">
                  <span v-if="fail.student_id === result.student_id">F</span>
                  <span v-else>{{result.gpa}}</span>
                </b>
                </span>
              </div>
            </div> <!-- /Row -->
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
  name: "ResultView",
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
      },
      results: [],
      fails: [],
      years: [],
      classes: [],
      exams: [],
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Result View'
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

        axios.post('/resultall', this.search).then(response => {

          let result = response.data.result
          this.fails = response.data.fails



          result.forEach(item => {



            let data = {
              class_id: item.class_id,
              year_id: item.year_id,
              exam_type_id: item.exam_type_id,
              student_id: item.student_id
            }

            let point = 0;
            // console.log(data)

            let id_number= item.student.id_number
            let student_id = item.student_id

            axios.get('/getmarks/'+data.year_id+'/'+data.class_id+'/'+data.exam_type_id+'/'+data.student_id).then(res=>{

              let subjects = res.data.studentmark.length
              res.data.studentmark.forEach(value => {

                point += parseFloat(value.grade_point)


              })

              let cgpa = parseFloat(point/subjects).toFixed(2)

              let data = {student_id: student_id, id_number:id_number, gpa: cgpa}
              this.results.push(data)
            })





          })

        }).catch(error => {

        })
      }
    },



    validateData(){
      if (this.search.year_id.length === 0 || this.search.class_id.length === 0 || this.search.exam_type_id.length === 0 ){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>
span.result {
  border: 1px solid #6c757d;
  padding: 10px 15px;
  border-radius: 12px;
  margin-right: 10px;
}
</style>