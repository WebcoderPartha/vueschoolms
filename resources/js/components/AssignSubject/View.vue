<template>
  <div class="contentBoxing">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assign Subject Class Details</h1>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
<!--                <h2 class="text-center">{{ assignSubjects[0].student_class.name }}</h2>-->
                <h2 class="text-center">{{ class_name }}</h2>
              </div>
              <div class="card-body">
                <table class="table table-striped text-center">
                  <tr v-for="(assignsubject, index) in assignSubjects" :key="index">
                    <td>{{ assignsubject.subject.name }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>


import axios from "axios";

export default {
  name: "AssignSubjectView",
  created() {
    this.getAssignSubjectByClassId();
  },

  data(){
    return {
      assignSubjects: '',
      class_name: ''
    }
  },
  methods:{

    pageTitle(){
      document.title = 'Assign Subject details'
    },
    authenticate(){
      if (!User.authenticate()){
        Notification.error('Please loin first!')
        this.$router.push({name:'login'})
      }
    },
    getAssignSubjectByClassId(){
      axios.get('/assignsubject/'+this.$route.params.id)
          .then(res => {
            this.assignSubjects = res.data
            this.class_name = res.data[0].student_class.name
          })
    }

  } // End Method
}
</script>

<style scoped>

</style>