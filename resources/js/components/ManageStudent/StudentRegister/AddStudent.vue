<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Student</h1>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Student</h3>
                </div>
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Name</span>
                        </div>
                        <input type="text" v-model="form.name" class="form-control" placeholder="Name">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Father Name</span>
                        </div>
                        <input type="text" v-model="form.father_name" class="form-control" placeholder="Father">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Mother Name</span>
                        </div>
                        <input type="text" v-model="form.mother_name" class="form-control" placeholder="Mother">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->

                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Date Of Birht</span>
                        </div>
                        <input type="date" v-model="form.date_of_birth" class="form-control">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Religion</span>
                        </div>
                        <select class="form-control" v-model="form.religion">
                          <option value="">Select religion</option>
                          <option value="Muslim">Muslim</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Buddhist">Buddhist</option>
                          <option value="Christian">Christian</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Gender</span>
                        </div>
                        <select class="form-control" v-model="form.gender">
                          <option value="">Select gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->


                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Email</span>
                        </div>
                        <input type="email" v-model="form.email" class="form-control" placeholder="Email">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Phone</span>
                        </div>
                        <input type="text" v-model="form.phone" class="form-control" placeholder="Phone">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Address</span>
                        </div>
                        <textarea v-model="form.address" class="form-control" placeholder="Address" cols="10" rows="2"></textarea>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->

                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Year</span>
                        </div>
                        <select class="form-control" v-model="form.year_id">
                          <option value="">Select year</option>
                          <option v-for="year in years" :key="year.id" :value="year.id">{{ year.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Class</span>
                        </div>
                        <select class="form-control" v-model="form.class_id">
                          <option value="">Select Class</option>
                          <option v-for="cls in classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Group</span>
                        </div>
                        <select class="form-control" v-model="form.group_id">
                          <option value="">Select Group</option>
                          <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->


                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Shift</span>
                        </div>
                        <select class="form-control" v-model="form.shift_id">
                          <option value="">Select shift</option>
                          <option v-for="shift in shifts" :key="shift.id" :value="shift.id">{{ shift.name }}</option>
                        </select>
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Discount (Registration Fee)</span>
                        </div>
                        <input type="text" class="form-control" v-model="form.discount_percentage" placeholder="Discount percentage %">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Image</span>
                        </div>
                        <input type="file" class="form-control" @change="ImageEvent">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->

                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <img width="100" src="" id="showImage" alt="">
                    </div>
                  </div>



                  <div class="">
                    <button type="submit" class="btn btn-primary">Add Student</button>
                    <router-link :to="{name:'studentlist'}" class="btn btn-danger float-right">Back</router-link>
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
  name: "AddStudent",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
    this.getyear();
    this.getGroup();
    this.getShift();

  },
  computed:{

  },
  data(){
    return {
      form: {
        name: '',
        father_name: '',
        mother_name: '',
        email: '',
        phone: '',
        address: '',
        date_of_birth: '',
        id_number: '',
        gender: '',
        religion: '',
        image: '',

        year_id: '',
        class_id: '',
        group_id: '',
        shift_id: '',
        discount_percentage: ''
      },

      years: [],
      classes: [],
      groups: [],
      shifts: [],

      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Add Student'
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

    getGroup(){
      axios.get('/group').then(res => this.groups = res.data)
    },
    getShift(){
      axios.get('/shift').then(res => this.shifts = res.data)
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
    ImageEvent(e){
      let files = e.target.files[0];
      if (files.size < 1048570){

        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.image = event.target.result;

          document.getElementById('showImage').src = event.target.result
        }
        reader.readAsDataURL(files);
      }else{
        Notification.error('Image must not be more then 1MB')
      }
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