<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Employee</h1>
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
                  <h3 class="card-title">Add Employee</h3>
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
                  </div>  <!-- End Row -->

                  <div class="row">

                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Joining Date</span>
                        </div>
                        <input type="date" v-model="form.joining_date" class="form-control">
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
                    </div> <!-- End Col -->

                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Designation</span>
                        </div>
                        <select class="form-control" v-model="form.designation_id">
                          <option value="">Select designation</option>
                          <option v-for="designation in designations" :key="designation.id" :value="designation.id">{{ designation.name }}</option>
                        </select>
                      </div>
                    </div><!-- End Col -->
                  </div><!-- /Row -->


                  <div class="row">

                    <div class="col-md-4">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Salary</span>
                        </div>
                        <input type="text" v-model="form.salary" class="form-control">
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
                    </div> <!-- End Col -->

                    <div class="col-md-4">
                      <div class="imageBox">
                        <img src="" width="100" id="showImage" alt="">
                      </div>
                    </div><!-- End Col -->
                  </div><!-- /Row -->
                  <div class="row">
                    <div class="col-md-4 mx-auto text-center">
                      <button class="btn btn-primary" type="submit">Add Employee</button>
                    </div>
                  </div>

                </div>  <!-- /.card-body -->
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
  name: "AddEmployee",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getDesignation();

  },
  computed:{

  },
  data(){
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        joining_date: '',
        designation_id: '',
        salary: '',
        image: '',
      },
      designations: [],
      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Add Employee'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getDesignation(){
      axios.get('/designation').then(res => this.designations = res.data)
    },


    storeData(){

      if (!this.validateData()){
        axios.post('/employee', this.form)
            .then(response => {
              this.$router.push({name: 'employee'})
              Notification.success(response.data);
            }).catch(error => {
          this.errors = error.response.data.errors
        })
      }

    },
    ImageEvent(e){
      let files = e.target.files[0];
      if (files.size < 1048570){

        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.image = event.target.result;

          document.getElementById('showImage').src = event.target.result
          console.log(this.form.image);
        }
        reader.readAsDataURL(files);
      }else{
        Notification.error('Image must not be more then 1MB')
      }
    },
    validateData(){
      if (this.form.name.length === 0 || this.form.email.length === 0 || this.form.phone.length === 0 || this.form.address.length === 0 ||  this.form.joining_date.length === 0 || this.form.salary.length === 0 || this.form.designation_id.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>