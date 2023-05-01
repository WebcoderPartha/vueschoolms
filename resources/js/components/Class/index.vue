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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="text-center">Class List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="classes.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Multi Select <br>
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(cls, index) in classes" :key="cls.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ cls.name }}</td>
                    <td>

                          <input type="checkbox" :value="cls.id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name:'edit_class', params:{id:cls.id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>
                      &nbsp;<button @click="deleteData(cls.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!classes.length > 0">No data found!</h3>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Class</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="storeData">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Class name</span>
                        </div>
                        <input type="text"  v-model="form.class_name" class="form-control" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button class="btn btn-sm btn-primary" @click.prevent="addItem">+</button> &nbsp;

                    </div>
                  </div>

                  <table class="table" v-show="form.name.length > 0">
                    <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(value, index) in form.name" :key="index+1">
                      <td>{{ index+1 }}</td>
                      <td>{{ value }}</td>
                      <td>
                        <button @click.prevent="removeItem(index)" class="btn btn-sm btn-danger">-</button>
                      </td>
                    </tr>

                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-primary">Store Data</button>
                </form>
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


import axios from "axios";

export default {
  name: "index",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getClass();
  },
  data(){
    return {
      form: {
        name: [],
        class_name: '',
      },
      checkBox: [],
      classes: [],
      // category: '',
      // categories: [{name:'ok'}, {name:'okey'}]
    }
  },
  methods:{
    deleteAll(){
      let data = {
        checkBox: this.checkBox
      }
      axios.post('/class/alldel', data).then(res => {
        this.getClass();
        this.checkBox = []
        this.$router.push({name:'classes'})
        Notification.success(res.data);
      })
    },
    deleteData(id){
      Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/class/'+id).then(res => {
            return this.classes = this.classes.filter(cls => {
              return cls.id !== id
            })
          })
          Swal.fire(
              'Deleted!',
              // 'Your file has been deleted.'+ id,
              'success'
          )
        }
      })
    },
    addItem(){

        if (this.form.class_name.length !== 0){

          this.form.name.push(this.form.class_name)
          if (this.form.name.indexOf(this.form.class_name) !== this.form.name.lastIndexOf(this.form.class_name)){

            Notification.error('Duplicate category not allowed!')
          }
          this.form.name = [...new Set(this.form.name)]
          this.form.class_name = ''

        }else{
          Notification.error('Field must not be empty!')
        }

    },
    pageTitle(){
      document.title = 'Classes'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getClass(){
      axios.get('/class').then(res => {
        this.classes = res.data
      })
    },

    removeItem(index){
      this.form.name.splice(index, 1);
    },
    storeData(){
      axios.post('/class', this.form).then(response => {
        // console.log(response.data);
        this.form.name = [];
        this.form.class_name = '';
        this.getClass();
        this.$router.push({name:'classes'})
        Notification.success(response.data)
      }).catch(error => {

      })
    }
    // validateData(){
    //   for (let i = 0; i < this.form.names.length; i++){
    //
    //     if (this.form.names[i]['name'].length === 0){
    //       Notification.error('Field must not be empty!')
    //       return true
    //     }
    //   }
    // }
  } // End Method
}
</script>

<style scoped>

</style>