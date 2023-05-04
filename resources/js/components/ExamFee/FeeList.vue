<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Exam Fee</h1>
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
                <h3>Exam Fee <RouterLink :to="{name:'add_examfee'}" class="btn btn-primary float-right">Add Exam Fee</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="examFees.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Year</th>
                    <th>Exam Type</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(examFee, index) in examFees" :key="index+1">
                    <td>{{ index + 1 }}</td>
                    <td>{{ examFee.year.name }}</td>
                    <td>{{ examFee.exam.name }}</td>
                    <td>

                      <input type="checkbox" :value="{year_id:examFee.year_id, exam_type_id:examFee.exam_type_id}" multiple v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name: 'edit_examfee', params:{year:examFee.year_id, exam:examFee.exam_type_id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>&nbsp;
                      <RouterLink :to="{name: 'examfee_datail', params:{year:examFee.year_id, exam:examFee.exam_type_id}}" class="badge bg-primary"><i class="fa fa-eye"></i></RouterLink>
                      &nbsp;<button @click="deleteData(examFee.year_id, examFee.exam_type_id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!examFees.length > 0">No data found!</h3>
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
  name: "ExamFeeList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getExamFee();
  },

  data(){
    return {

      examFees: [],
      checkBox: [],

    }
  },
  computed: {
    selectAll: {
      get:function (){
        return this.examFees ? this.examFees.length === this.checkBox.length : false
      },
      set: function (value){

        let arrayValue = [];
        if (value){
          this.examFees.forEach(examFee => {
            arrayValue.push({year_id:examFee.year_id, exam_type_id: examFee.exam_type_id})
          });
        }

        this.checkBox = arrayValue;

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
          axios.post('/examfee/alldel', data).then(res => {
            this.getExamFee();
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

    deleteData(year_id, exam_type_id){

      Swal.fire({
        title: 'Are you sure?'+this.partha,
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/examfee/'+year_id+'/'+exam_type_id).then(res => {
            this.getExamFee()
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
      document.title = 'Exam Fee list'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getExamFee(){
      axios.get('/examfee').then(res => {

        this.examFees = res.data;
      })
    }

  } // End Method
}
</script>

<style scoped>

</style>