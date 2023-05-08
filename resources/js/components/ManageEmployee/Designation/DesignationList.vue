<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Designation</h1>
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
                <h3 class="text-center">Designation List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="designations.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th><input type="checkbox" v-model="allSelect">All Select
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(designation, index) in designations" :key="designation.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ designation.name }}</td>
                    <td>

                      <input type="checkbox" :value="designation.id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name:'designationedit', params:{id:designation.id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>
                      &nbsp;<button @click="deleteData(designation.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!designations.length > 0">No data found!</h3>
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
                <h3 class="card-title">Add Designation</h3>
              </div>
              <div class="card-body">
                <form @submit.prevent="storeData" ref="form">
<!--                  <div class="row" v-for="(names, index) in form.names" :key="index">-->
                  <div class="row" v-for="(value, index) in form.names" :key="index">
                    <div class="col-md-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Designation name</span>
                        </div>
                        <input type="text"  v-model="value.name" class="form-control" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button class="btn btn-sm btn-primary" @click.prevent="addItem">+</button> &nbsp;
                      <button class="btn btn-sm btn-danger" @click.prevent="removeItem(index)" v-if="index > 0">-</button>


                    </div>
                  </div>

<!--                  <table>-->
<!--                    <tr v-for="(name, index) in this.form.names" :key="index">-->
<!--                      <td>{{ name.name}}</td>-->
<!--                      <td><button class="btn btn-sm btn-danger" @click.prevent="removeItem(index)" v-if="index > 0">-</button></td>-->
<!--                    </tr>-->
<!--                  </table>-->
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



export default {
  name: "DesignationList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getDesignation();
  },

  data(){
    return {
      form: {
        names: [{name: ''}]
      },
      addName: [],
      checkBox: [],
      designations: [],
    }
  },
  computed: {
    allSelect: {
      get: function (){
        return this.designations ? this.designations.length === this.checkBox.length : false;
      },
      set: function (value){

        let selected = [];
        if (value){
          this.designations.forEach(designation => {
            selected.push(designation.id)
          })
        }

        this.checkBox = selected

      }
    }
  },
  methods:{

    deleteAll(){

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
          let data = {
            checkBox: this.checkBox
          }
          axios.post('/designation/alldel', data).then(res => {
            this.getDesignation();
            this.checkBox = []
            Notification.success(res.data);
          })
          Swal.fire(
              'Deleted!',
              // 'Your file has been deleted.'+ id,
              'success'
          )
        }
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
          axios.delete('/designation/'+id).then(res => {
            return this.designations = this.designations.filter(designation => {
              return designation.id !== id
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

      if (!this.validationDta()){

        let item = this.form.names.find(item => item.name === this.addName);
        if (!item){
          this.form.names.push({name: this.addName})

        }else{
          Notification.error('Duplicate')
        }

        this.form.names = [...new Map(this.form.names.map(item=> [item['name'],item])).values()]
        // this.addName = ''
        console.log(this.form.names)

      }


    },
    pageTitle(){
      document.title = 'Designation'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getDesignation(){
      axios.get('/designation').then(res => {
        this.designations = res.data
      })
    },

    removeItem(index){
      this.form.names.splice(index, 1);
    },
    storeData(){
      if (!this.validationDta()){
        axios.post('/designation', this.form).then(response => {
          // console.log(response.data);
          this.$refs.form.reset();
          this.getDesignation();
          this.form.names = [{name: ''}]
          Notification.success(response.data)

        }).catch(error => {

        })
      }

    },
    validationDta(){
      // this.form.names.forEach(item=> {
      //   if (item.name.length === 0){
      //     Notification.error('Field must not be empty!')
      //     return true
      //   }
      // })
      for (let i = 0; i < this.form.names.length; i++){
        if (this.form.names[i].name.length === 0){
          Notification.error('Field must not be empty!')
          return true;
        }
      }

      // if (this.addName.length === 0){
      //   Notification.error('Field must not be empty!');
      //   return true;
      // }
    }

  } // End Method
}
</script>

<style scoped>

</style>