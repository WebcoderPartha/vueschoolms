<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Detail</h1>
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
                <h3>Student Detail <RouterLink :to="{name:'studentlist'}" class="btn btn-primary float-right">Student List</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tr>
                    <td>Name: </td>
                    <td>{{ student.name}}</td>
                  </tr>
                  <tr>
                    <td>Father: </td>
                    <td>{{ student.father_name}}</td>
                  </tr>
                  <tr>
                    <td>Mother: </td>
                    <td>{{ student.mother_name}}</td>
                  </tr>
                  <tr>
                    <td>Date of Birth: </td>
                    <td>{{ student.date_of_birth}}</td>
                  </tr>
                  <tr>
                    <td>Gender: </td>
                    <td>{{ student.gender}}</td>
                  </tr>
                  <tr>
                    <td>Religion: </td>
                    <td>{{ student.religion}}</td>
                  </tr>
                  <tr>
                    <td>Address: </td>
                    <td>{{ student.address}}</td>
                  </tr>
                  <tr>
                    <td>Image: </td>
                    <td><img :src="imagePath(student.image)" width="100" alt=""></td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->

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
  name: "StudentList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getByIdData();
  },

  data(){
    return {

      student: ''

    }
  },

  methods:{

    pageTitle(){
      document.title = 'Student Detail'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getByIdData(){
      axios.get('/student/'+this.$route.params.id).then(response => {
        this.student = response.data;
        console.log(this.student)
      })
    },

    imagePath(path){
      return '/'+path
    }

  } // End Method
}
</script>

<style scoped>

</style>