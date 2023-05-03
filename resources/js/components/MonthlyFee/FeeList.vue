<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Monthly Fee</h1>
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
                <h3>Monthly Fee <RouterLink :to="{name:'add_monthlyfee'}" class="btn btn-primary float-right">Add Monthly Fee</RouterLink></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" v-show="monthlyFees.length > 0">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th><input type="checkbox" v-model="selectAll"> Select All
                      <button class="btn btn-sm btn-danger" @click="deleteAll" v-show="checkBox.length > 0"><i class="fa fa-trash-alt"></i></button>
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(monthlyFee, index) in monthlyFees" :key="index+1">
                    <td>{{ index + 1 }}</td>
                    <td>{{ monthlyFee.year.name }}</td>
                    <td>{{ monthlyFee.month.name }}</td>
                    <td>

                      <input type="checkbox" :value="monthlyFee.year_id" :partha="monthlyFee.month_id" v-model="checkBox">


                    </td>
                    <td>
                      <RouterLink :to="{name: 'edit_monthlyfee', params:{year:monthlyFee.year_id, month:monthlyFee.month_id}}" class="badge bg-info"><i class="fa fa-edit"></i></RouterLink>&nbsp;
                      <RouterLink :to="{name: 'monthlyfee_detail', params:{year:monthlyFee.year_id, month:monthlyFee.month_id}}" class="badge bg-primary"><i class="fa fa-eye"></i></RouterLink>
                      &nbsp;<button @click="deleteData(monthlyFee.year_id, monthlyFee.month_id)"  class="badge bg-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h3 class="text-center" v-show="!monthlyFees.length > 0">No data found!</h3>
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
  name: "MonthlyFeeList",
  created() {
    this.authenticate();
    this.pageTitle();
    this.getMonthlyFee();
  },
  props: ['partha'],
  data(){
    return {

      monthlyFees: [],
      checkBox: [],
      year_id: []
    }
  },
  computed: {
    selectAll: {
      get:function (){
        return this.monthlyFees ? this.monthlyFees.length === this.checkBox.length : false
      },
      set: function (value){

        let arrayValue = [];
        if (value){
          this.monthlyFees.forEach(monthlyFee => {
            arrayValue.push(monthlyFee.class_id)
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
          axios.post('/monthlyfee/alldel', data).then(res => {
            this.getMonthlyFee();
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
    yearIdEvent(e){

    },
    deleteData(year_id, month_id){

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
          axios.delete('/monthlyfee/'+year_id+'/'+month_id).then(res => {
            return this.monthlyFees = this.monthlyFees.filter(monthlyFee => {
              return monthlyFee.year_id !== year_id
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
      document.title = 'Monthly Fee list'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },

    getMonthlyFee(){
      axios.get('/monthlyfee').then(res => {

        this.monthlyFees = res.data;
        console.log(this.monthlyFees)
      })
    }

  } // End Method
}
</script>

<style scoped>

</style>