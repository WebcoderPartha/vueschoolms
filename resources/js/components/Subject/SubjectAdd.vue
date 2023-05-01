<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subject</h1>
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
            <div class="col-md-3"></div>
            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add Subject</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Subject name</span>
                        </div>
                        <input type="text"  v-model="add_subject" class="form-control" placeholder="name">
                      </div>
                      <small class="text-red" v-if="errors.name">{{ errors.name[0]}}</small>
                    </div>
                    <div class="col-md-2">
                      <button @click.prevent="addItem" class="btn btn-sm btn-primary">+</button>

                    </div>
                  </div>
                  <router-link :to="{name:'subject'}" class="btn btn-danger">Back</router-link>

                </div>

                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-6" v-show="this.form.name.length > 0">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Addable Data</h3>
                </div>
                <div class="card-body">
                  <table class="table-bordered table">
                    <tr v-for="(value,index) in this.form.name">
                      <td>{{index+1}}</td>
                      <td>{{value}}</td>
                      <td>
                        <span @click.prevent="removeItem(index)" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt" style="font-size: 10px"></i></span>
                      </td>
                    </tr>
                  </table>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-2">Insert Listed</button>
                  </div>

                </div>

                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-3"></div>
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
  name: "ShiftAdd",
  created() {
    this.authenticate();
    this.pageTitle();
  },
  data(){
    return {
      form: {
        name: []
      },
      add_subject: '',
      errors: []

    }
  },
  methods:{
    pageTitle(){
      document.title = 'Add Subject'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    addItem(){

      if (!this.validateData()){
        this.form.name.push(this.add_subject)
        if (this.form.name.indexOf(this.add_subject) !== this.form.name.lastIndexOf(this.add_subject)){
          Notification.error('Should not be Duplicate data!')
        }
        this.form.name = [...new Set(this.form.name)]
        this.add_subject = ''
      }

    },
    removeItem(index){
      this.form.name.splice(index,1);
    },
    storeData(){
      let data  = {
        name: this.form.name
      }
      axios.post('/subject', data)
          .then(response => {
            this.$router.push({name: 'subject'})
            Notification.success(response.data);
          }).catch(error => {
        this.errors = error.response.data.errors
      })

    },
    validateData(){
      if (!this.add_subject > 0){
        Notification.warning('Field must not be empty!')
        return true
      }
    }

  } // End Method
}
</script>

<style scoped>

</style>