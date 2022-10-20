<template>
    <lodaer-component></lodaer-component>

    <!--  Show Data -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">create new task</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div v-show="create_seccessfuly !== ''"  class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{create_seccessfuly}}</strong>
                    <button type="button" class="close"  @click="create_seccessfuly = ''">
                        <span>&times;</span>
                    </button>
                </div>

                <form method="post" action="./api/storeTask" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Title" class="col-form-label">Title:</label>
                                    <input type="text" placeholder="title" class="form-control" name="title" v-model="taskData.title">
                                    <span class="text-danger" v-show="taskErrors.title">this field is require</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date" class="col-form-label">Date:</label>
                                    <input type="date" class="form-control" name="date" v-model="taskData.date">
                                    <span class="text-danger" v-show="taskErrors.date">this field is require</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="time" class="col-form-label">Time:</label>
                                    <input type="time" class="form-control" name="time" v-model="taskData.time">
                                    <span class="text-danger" v-show="taskErrors.time">this field is require</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail" class="col-form-label">detail:</label>
                                    <textarea  placeholder="Details" class="form-control" rows="3" name="detail" v-model="taskData.detail"></textarea>
                                    <span class="text-danger" v-show="taskErrors.details">this field is require</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail" class="col-form-label">Upload File:</label>
                                    <input type="file" class="form-control" id="task_file" @change="selectedTaskFile">
                                    <span class="text-danger" v-show="taskErrors.details">this field is require</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="storeTask()" class="btn btn-primary" >create new</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!--  create task  Model-->

</template>
<script>
import axios from "axios";

export default{
    setup:() => ({
        title:"All Tasks"
    }),
    data(){
        return{
            create_seccessfuly : "",
            taskData:{
                id      :'',
                title   :'',
                date    :'',
                time    :'',
                detail  :'',
                task_file:'',
            },
            taskErrors:{
                title:      false,
                date:       false,
                time:       false,
                detail:     false,
                task_file:  false
            },
            getTasksData: {},
        }//end return
    },
    methods:{

        storeTask(){
            this.taskData.title     == "" ? this.taskErrors.title       = true : this.taskErrors.title    = false
            this.taskData.date      == '' ? this.taskErrors.date        = true : this.taskErrors.date     = false
            this.taskData.time      == '' ? this.taskErrors.time        = true : this.taskErrors.time     = false
            this.taskData.detail    == '' ? this.taskErrors.detail      = true : this.taskErrors.detail    = false
            //this.taskData.task_file == '' ? this.taskErrors.task_file   = true : this.taskErrors.task_file = false
            if(this.taskData.title && this.taskData.date && this.taskData.time && this.taskData.detail){

                axios.post('/api/storeTask', this.taskData).then(response => {
                    console.log(response.data)
                }).catch(errors => {
                    console.log('here is you problems' + errors)
                }).finally(()=>{
                    this.create_seccessfuly = 'task had been created'
                    this.taskData = {
                        title       :  '',
                        date        :  '',
                        time        :  '',
                        detail      :  '',
                        task_file   :  '',
                    }
                    document.querySelector("#task_file").value = ""
                });
            }else {
                console.log('you have to complate the fields')
            }
        },//end  store task
        selectedTaskFile(e){
            //console.log(e)
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                this.taskData.task_file = reader.result;
            }
            reader.readAsDataURL(file);
            console.log(this.taskData.task_file)
        },//End Selected Task File

    }//end method
}

//
</script>
