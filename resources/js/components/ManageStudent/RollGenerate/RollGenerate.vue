<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Roll Generate</h1>
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
            <div class="col-md-8 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Student    <router-link :to="{name:'studentlist'}" class="btn btn-danger float-right">Back</router-link></h3>
                </div>
                <div class="card-body">
                  <form @submit.prevent="SearchRollGenerate">
                    <div class="row">
                      <div class="col-md-4">
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
                      <div class="col-md-4">
                        <div class="input-group mb-5">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Class</span>
                          </div>
                          <select class="form-control" v-model="search.class_id">
                            <option value="">Select Class</option>
                            <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                          </select>
                        </div>
                        <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
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
        </form>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <form action="">
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
                  <th>Shift</th>
                  <th>Group</th>
                  <th width="140px">Roll</th>
                </tr>
                </thead>
                <tbody>
                  <tr v-for="(student, index) in RollGenStudents" :key="index">
                    <td>{{ student.student.id_number}}</td>
                    <td>{{ student.student.name}}</td>
                    <td>{{ student.year.name}}</td>
                    <td>{{ student.shift.name}}</td>
                    <td>{{ student.group.name}}</td>
                    <td>{{ student.student_class.name}}</td>
                    <td><input type="text" class="form-control" :data-student-id="student.student.id" @change="rollGenerateEvent"  placeholder="Roll"></td>

                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer text-center">
              <button class="btn btn-primary" type="submit">Roll Generate</button>
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
  name: "RollGenerate",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getyear();


  },
  computed:{

  },
  data(){
    return {
      search:{
        class_id: '',
        year_id: ''
      },
      form: {
        roll_generate: [],
      },
      RollGenStudents: [],
      add_roll:'',
      addArray: [],
      years: [],
      classes: [],

      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Roll Generate'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    rollGenerateEvent(event){
      let student_id = event.target.getAttribute('data-student-id')
      let roll_number = event.target.value;
      this.form.roll_generate.push({student_id: student_id, roll_number: roll_number})

      console.log(this.form.roll_generate)
    },
    getClass(){
      axios.get('/class').then(res => this.classes = res.data)
    },
    getyear(){
      axios.get('/year').then(res => this.years = res.data)
    },
    SearchRollGenerate(){
      axios.get('/searchrolgen/'+this.search.year_id+'/'+this.search.class_id)
          .then(response => {
            this.RollGenStudents = response.data;
            console.log(this.RollGenStudents)
          }).catch(error => {
      })
    },
    storeData(){

      axios.post('/student', this.form)
          .then(response => {
            this.$router.push({name: 'studentlist'})
            Notification.success(response.data);
          }).catch(error => {
        this.errors = error.response.data.errors
      })

    },

    validateData(){
      if (this.form.exam_type_id.length === 0 || this.add_class_id.length === 0 || this.add_amount.length === 0 || this.form.year_id.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>