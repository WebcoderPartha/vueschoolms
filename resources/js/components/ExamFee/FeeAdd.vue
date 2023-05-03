<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Exam Fee</h1>
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
            <div class="col-md-1"></div>
            <div class="col-md-8 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Exam Fee</h3>
                </div>
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-5">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Year</span>
                        </div>
                        <select class="form-control" @change="YearEvent">
                          <option value="">Select Year</option>
                          <option v-for="year in years" :key="year.id" :value="year.id">{{ year.name }}</option>
                        </select>
                      </div>
                    </div> <!-- End Col -->

                    <div class="col-md-5">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Exam Type</span>
                        </div>
                        <select class="form-control" @change="examEvent">
                          <option value="">Select exam type</option>
                          <option v-for="exam in exams" :key="exam.id" :value="exam.id">{{ exam.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div><!-- End Col -->

                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Class</span>
                        </div>
                        <select class="form-control" v-model="add_class_id">
                          <option value="">Select class</option>
                          <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div>

                    <div class="col-md-5">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Amount</span>
                        </div>
                        <input type="text" v-model="add_amount" class="form-control" placeholder="Enter amount">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div>
                    <div class="col-md-2">
                      <button @click.prevent="addItem" class="btn btn-sm btn-primary">+</button>

                    </div>
                  </div>
                  class-id: {{form.class_id}} Amount: {{form.amount}} Year_id:{{form.year_id}}<br>
                  class Show: {{class_show}} Year_id:{{year_show}} || month_id {{form.exam_type_id}} || {{show_exam}}
                  <router-link :to="{name:'monthlyfee'}" class="btn btn-danger">Back</router-link>

                </div>

                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-1"></div>
          </div>
          <div class="row">

            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <!--                  {{subject_name}}        {{class_names}}-->
                  <h5 class="text-center">Addable Data <br> Exam Fee</h5>

                  <hr>
                  <h5 class="text-center">{{ year_show }} || {{ show_exam}}</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 mx-auto" >
                      <div class="row">
                        <div class="col-md-6 pr-0">
                          <table class="table-bordered table">
                            <tr v-for="(class_name, index) in class_show" :key="index">
                              <td>{{class_name}} &nbsp; || &nbsp;      <button class="btn btn-sm btn-danger" @click.prevent="removeItem(index)">X</button></td>
                            </tr>

                          </table>
                        </div>
                        <div class="col-md-6 pl-0">
                          <table class="table-bordered table">
                            <tr v-for="(value, index) in this.form.amount" :key="index">
                              <td>{{value}} &nbsp; || &nbsp;      <button @click.prevent="removeItem(index)" class="btn btn-sm btn-danger">X</button></td>
                            </tr>

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-2" disabled v-if="this.form.exam_type_id.length === 0 || this.form.class_id.length === 0 || this.form.amount.length === 0 || this.form.year_id.length === 0">Insert Listed</button>
                    <button type="submit" class="btn btn-primary mt-2"  v-else>Insert Listed</button>
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
  name: "ExamFeeAdd",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getyear();
    this.getExamType();

  },
  computed:{

  },
  data(){
    return {
      form: {
        year_id: '',
        exam_type_id: '',
        class_id: [],
        amount: [],
      },
      add_class_id: '',
      add_amount: '',
      years: [],
      classes: [],
      exams: [],

      errors: [],
      class_show: [],
      year_show: '',
      show_exam: ''
    }
  },
  methods:{

    pageTitle(){
      document.title = 'Add Exam Fee'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    addItem(){

      if (!this.validateData()){

        this.form.class_id.push(this.add_class_id);
        this.form.amount.push(this.add_amount);

        axios.get('/class/'+this.add_class_id).then(res => {
          this.class_show.push(res.data.name)
        });


        if (this.form.class_id.indexOf(this.add_class_id) !== this.form.class_id.lastIndexOf(this.add_class_id)){
          Notification.error('Should not be Duplicate data!')
          // Remove for duplicate Class..  That's why i remove last index amount
          this.form.amount.splice(this.form.amount.lastIndexOf(), 1);
          // this.class_show.splice(this.form.amount.lastIndexOf(), 1);
        }

        this.form.class_id = [...new Set(this.form.class_id)]

        axios.get('/class/'+this.add_class_id).then(res => {
          this.class_show = [...new Set(this.class_show)]
        });
        this.add_class_id = '';
        this.add_amount = '';
      }

    },
    removeItem(index){
      this.form.class_id.splice(index, 1);
      this.form.amount.splice(index, 1);
      this.class_show.splice(index, 1);
    },
    YearEvent(e){
      this.form.year_id = e.target.value
      axios.get('/year/'+e.target.value).then(res => this.year_show = res.data.name)
    },
    examEvent(e){
      this.form.exam_type_id = e.target.value
      axios.get('/examtype/'+e.target.value).then(res => this.show_exam = res.data.name);
      console.log(this.show_month)
    },
    getClass(){
      axios.get('/class').then(res => this.classes = res.data)
    },
    getyear(){
      axios.get('/year').then(res => this.years = res.data)
    },
    getExamType(){
      axios.get('/examtype').then(res => this.exams = res.data)
    },

    storeData(){

      axios.post('/examfee', this.form)
          .then(response => {
            this.$router.push({name: 'examfee'})
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