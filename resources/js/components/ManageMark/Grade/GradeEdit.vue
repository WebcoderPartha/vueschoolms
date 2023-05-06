<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Grade</h1>
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
            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Edit Grade</h3>
                </div>
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Grade Name</span>
                        </div>
                        <input type="text" v-model="form.grade_name" class="form-control" placeholder="Grade Name">
                      </div>

                    </div> <!-- End Col -->
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Grade Point</span>
                        </div>
                        <input type="text" v-model="form.grade_point" class="form-control" placeholder="Grade point">
                      </div>
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Start Mark</span>
                        </div>
                        <input type="text" v-model="form.start_mark" class="form-control" placeholder="Start Mark">
                      </div>
                    </div> <!-- End Col -->
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">End Mark</span>
                        </div>
                        <input type="text" v-model="form.end_mark" class="form-control" placeholder="End Mark">
                      </div>
                    </div> <!-- End Col -->
                  </div>  <!-- End Row -->


                  <div class="">
                    <button type="submit" class="btn btn-primary">Update Grade</button>
                    <router-link :to="{name:'gradelist'}" class="btn btn-danger float-right">Back</router-link>
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
  name: "EditGrade",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getDataById();

  },
  computed:{

  },
  data(){
    return {
      form: {
        grade_name: '',
        grade_point: '',
        start_mark: '',
        end_mark: '',
      },

      errors: [],

    }
  },
  methods:{

    pageTitle(){
      document.title = 'Edit Grade'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getDataById(){
      axios.get('/grade/'+this.$route.params.id)
          .then(response => {
            this.form = response.data
          }).catch(error => {
      })
    },
    updateData(){

      if (!this.validateData()){
        axios.put('/grade/'+this.$route.params.id, this.form)
            .then(response => {
              this.$router.push({name: 'gradelist'})
              Notification.success(response.data);
            }).catch(error => {
          this.errors = error.response.data.errors
        })
      }

    },

    validateData(){
      if (this.form.grade_name.length === 0 || this.form.grade_point.length === 0 || this.form.start_mark.length === 0 || this.form.end_mark.length === 0){
        Notification.error('Field must not be empty!')
        return true;
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>