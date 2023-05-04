<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Student</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <form @submit.prevent="updateData">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Edit Student</h3>
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
                          <span class="input-group-text">Image</span>
                        </div>
                        <input type="file" class="form-control" @change="ImageEvent">
                      </div>
                      <!--                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>-->
                    </div> <!-- End Col -->

                    <div class="col-md-4">
                      <img width="100" :src="imagePath(form.image)" id="showImage" alt="">
                    </div>
                  </div>  <!-- End Row -->


                  <div>
                    <button type="submit" class="btn btn-primary">Update Student</button>
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
  name: "EditStudent",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getByIdData()
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
      },
      new_image: ''
    }
  },
  methods:{

    pageTitle(){
      document.title = 'Edit Student'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getByIdData(){
      axios.get('/student/'+this.$route.params.id).then(response => {
        this.form = response.data
      })
    },

    ImageEvent(e){
      let files = e.target.files[0];
      if (files.size < 1048570){

        let reader = new FileReader();
        reader.onload = (event) => {
          this.new_image = event.target.result;

          document.getElementById('showImage').src = event.target.result
        }
        reader.readAsDataURL(files);
      }else{
        Notification.error('Image must not be more then 1MB')
      }
    },
    imagePath(path){
      return '/'+path;
    },
    updateData(){
      const data = {
        form: this.form,
        new_image: this.new_image
      }
      axios.put('/student/'+this.$route.params.id, data).then(response => {
        this.$router.push({
          name: 'studentlist'
        });
        Notification.success(response.data)
        // console.log(response.data)
      })
    }


  } // End Method
}
</script>

<style scoped>

</style>