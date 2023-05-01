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
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3>Subject list <RouterLink :to="{name:'add_subject'}" class="btn btn-primary float-right">Add Subject</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="subjects.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="selected.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(subject, index) in subjects" :key="subject.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ subject.name }}</td>
                    <td>

                      <input type="checkbox" :value="subject.id" v-model="selected">


                    </td>
                    <td>
                      <RouterLink :to="{name:'edit_subject', params:{id:subject.id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>
                      &nbsp;<button @click="deleteData(subject.id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!subjects.length > 0">No data found!</h3>
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
    this.getSubject();
  },
  data(){
    return {
      subjects: [],
      selected: []
    }
  },
  computed: {
    selectAll: {
      get: function(){
        return this.subjects ? this.subjects.length === this.selected.length : false;
      },
      set: function(value){
        let selected = [];

        if (value){

          this.subjects.forEach(group => {
            selected.push(group.id)
          })

        }
        this.selected = selected;

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
            selected: this.selected
          }
          axios.post('/subject/alldel', data).then(res => {
            this.getSubject();
            this.selected = []
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
          axios.delete('/subject/'+id).then(res => {
            return this.subjects = this.subjects.filter(subject => {
              return subject.id !== id
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

    pageTitle(){
      document.title = 'Subject'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getSubject(){
      axios.get('/subject').then(res => {
        this.subjects = res.data
      })
    },


  } // End Method
}
</script>

<style scoped>

</style>