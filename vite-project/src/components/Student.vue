<template>
   

        <!-- <div :style="{'background-image': `url(${require('./assets/uni.jpg')})`}"> -->
            
        <!-- <img src="../assets/uni.jpg" alt=""> -->
        <div class="container">
        <div class="row justify-content-center">
        
        <div class="col-md-10">
            <h1 class="text-center text-dark mt-2">New Registrations</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    LAP Student List
                </div>
                <div class="card-body">
                    <form @submit.prevent="save">
                        <div class="form-group">
                            <label>Student name</label>
                            <input type="text" v-model="student.name" class="form-control" placeholder="Student name">
                        </div>
                        <div class="form-group">
                            <label>Student Address</label>
                            <input type="text" v-model="student.address" class="form-control" placeholder="Student Address">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" v-model="student.phone" class="form-control" placeholder="Phone">
                        </div>
                        <!-- <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" @change="onFileSelected" class="form-control-file" accept="image/*">
                        </div> -->
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
  

                </div>
            </div>
            <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Student List</h2>
            <table class="table rounded table-silver table-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <!-- <th scope="col">Profile_Pic</th> -->
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in result" v-bind:key="student.id">
                        <td>{{ student.id }}</td>
                        <td>{{ student.name }}</td>
                        <td>{{ student.address }}</td>
                        <td>{{ student.phone }}</td>
                        <!-- <td>{{ student.profile_pic }}</td> -->
                        <td>
                            <button type="button" class="btn btn-white" @click="edit(student)">Edit</button>
                            <button type="button" class="btn btn-dark"  @click="remove(student)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



</template>
<!-- <style>
.img{
    background-image:url("./assets/uni.jpg");
    background-repeat: no-repeat;
    background:cover;
    background-size: cover;
}
</style> -->

<script>
// import Vue from 'vue';
import axios from 'axios';
// import VueAxios fomr'vue-axios';
// Vue.use(VueAxios,axios)
  export default {
      name: 'Student',
      data () {
        return {
          result: {},
          student:{
                     id: '',
                     name: '',
                     address: '',
                     phone: '',
                     profile_pic:null
    
          

          }
        }
      },
      created() { 
          this.StudentLoad();
      },
      mounted() {
            console.log("mounted() called.......");
      },
    
      methods: {
             StudentLoad()
             {
                   var page = "http://127.0.0.1:8000/api/student";
                   axios.get(page)
                    .then(
                        ({data})=>{
                          console.log(data);
                          this.result = data;
                        }
                    );
             },
              
             save()
             {
              if(this.student.id == '')
                {
                  this.saveData();
                }
                else
                {
                  this.updateData();
                }       
    
             },
             saveData()
             {
                    axios.post("http://127.0.0.1:8000/api/student", this.student)
                      .then(({data}) => {
                       alert("saved");
                      this.StudentLoad();
                      this.student.name = '';
                      this.student.address = '';
                      this.student.phone = '';
                    //   this.student.profile_pic = '';
                      this.id = '';
                })
          //           // .catch((error) => {
          //           // console.error(error);
          //           // alert("Error occurred while saving data. Please try again later.");
          // });
            
             },
             edit(student)
             {
              this.student = student;
             },
             updateData()
             {
              var editrecords = 'http://127.0.0.1:8000/api/student/'+ this.student.id;
                    axios.put(editrecords, this.student)
                    .then(({data}) => {
                    this.student.name = '';
                    this.student.address = '';
                    this.student.phone = '';
                    // this.student.profile_pic = null;
                    // var fileUrl=window.URL.createObjectURL(new Blob((response.data)))
                    // var fileLink = document.createElement('a')
                    // fileLink.herf =fileUrl
                    // fileLink.setAttribute('download,image.jpg')
                    // document.body.appendChild(fileLink)
                    // fileLink.click()
                    this.id = '';
                    alert("Updated!!!");
                    this.StudentLoad();
                  })
                  // .catch((error) => {
                  //   console.error(error);
                  //   alert("Error occurred while updating data. Please try again later.");
                  // });

             },
    
             remove(student){
                var url = `http://127.0.0.1:8000/api/student/${student.id}`;
                // var url = 'http://127.0.0.1:8000/api/student/'+ student.id;
                axios.delete(url);
                alert("Deleted");
                this.StudentLoad();
              }
        }
    }
    </script>