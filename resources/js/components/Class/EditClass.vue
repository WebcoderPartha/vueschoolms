<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Classes</h1>
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
                <h3 class="card-title">Edit Class</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="updateData">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Class name</span>
                        </div>
                        <input type="text"  v-model="form.name" class="form-control" placeholder="name">
                      </div>

                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-sm btn-primary">Update</button>

                    </div>
                  </div>

                </form>
                <router-link :to="{name:'classes'}" class="btn btn-info">Back</router-link>
              </div>

              <!-- /.card-body -->
            </div>
          </div>

        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


export default {
  name: "index",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClassById();
  },
  data(){
    return {
      form: {
        name: ''
      },
      errors: []

    }
  },
  methods:{
    pageTitle(){
      document.title = 'Edit Class'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getClassById(){
      axios.get('/class/'+this.$route.params.id).then(res=> this.form = res.data)
    },
    updateData(){
      if (!this.validateData()){
        axios.put('/class/'+this.$route.params.id, this.form)
            .then(response => {
              this.$router.push({name: 'classes'})
              Notification.success(response.data);
            }).catch(error => {
              this.errors = error.response.data.errors
        })
      }
    },
    validateData(){
      if (!this.form.name.length > 0){
        Notification.warning('Field must not be empty!')
        return true
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>