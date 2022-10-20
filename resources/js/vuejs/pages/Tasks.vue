<template>
    <lodaer-component></lodaer-component>

    <!--  Show Data -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tasks Page</h3>
                <Button type="info ivu-fr"  data-toggle="modal" data-target="#addTask" data-whatever="@mdo"><Icon type="ios-add-circle-outline" /> Add New</Button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Task Name</th>
                        <th>date & Time</th>
                        <th>description</th>
                        <th>Sub Task</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item,index) in getTasksData" :key="index">
                        <td>{{index + 1}}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.date }} | {{ item.time }}</td>
                        <td>{{ item.detail.length <= 20 ? item.detail : item.detail.substr(0,20) + '...' }}</td>
                        <td>{{item.sub_task.length}}</td>
                        <td class="ivu-text-center">
                            <Button @click="EditTask(item)" type="primary"  data-toggle="modal" data-target="#editTask" data-whatever="@mdo">Edit</Button>
                            <Button @click="removeTask(item)" type="error" class="ivu-ml">Delete</Button>
                        </td>
                    </tr>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!--  create task  Model-->
    <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskLabel">Create New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div v-show="create_seccessfuly !== ''" class="modal-header">
                   <div class="">{{create_seccessfuly}}</div>
                </div>
                    <form method="post" action="./api/storeTask" >
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Title" class="col-form-label">Title:</label>
                                        <input type="text" class="form-control" name="title" v-model="taskData.title">
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
                                        <textarea class="form-control" rows="3" name="detail" v-model="taskData.detail"></textarea>
                                        <span class="text-danger" v-show="taskErrors.details">this field is require</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" @click="storeTask()" class="btn btn-primary" >create new</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--  update task  Model-->
    <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="addTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskLabel">Edit Task</h5>
                    {{getTasksDataToUpdate}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div v-show="create_seccessfuly !== ''" class="modal-header">
                    <div class="">{{create_seccessfuly}}</div>
                </div>
                <form method="post" action="./api/storeTask" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Title" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" name="title" v-model="taskData.title">
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
                                    <textarea class="form-control" rows="3" name="detail" v-model="taskData.detail"></textarea>
                                    <span class="text-danger" v-show="taskErrors.details">this field is require</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTask()" class="btn btn-primary" >Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                id:'',
                title:'',
                date:'',
                time:'',
                detail:'',
            },
            taskErrors:{
                title: false,
                date: false,
                time: false,
                detail: false,
            },
            getTasksData: {},
        }//end return
    },
    mounted() {
        this.getTasks()
    },//end mounted
    methods:{
        getTasks(){
            window.emitter.emit('changeLoadingStatus',true)
            axios.get('/api/getTask').then(res=>{
                this.getTasksData = res.data
                window.emitter.emit('changeLoadingStatus',false)
            }).catch(errors=>{
                console.log(errors)
            })
        },
        removeTask(item){
            //console.log(item.id);
            this.taskData = {id:item.id}
            axios.post('/api/removeTask/' + this.taskData.id).then(response => {
                console.log('successfuly' + response.data)
                this.getTasks()
            }).catch(errors => {
                console.log('here is you problems' + errors)
            })

        },//removeTask
        updateTask(){
            if(this.taskData.title && this.taskData.date && this.taskData.time && this.taskData.detail){

                axios.post('/api/updateTask/'+ this.taskData.id, this.taskData).then(response => {
                    this.getTasks()
                }).catch(errors => {
                    console.log('here is you problems'.errors)
                }).finally(()=>{
                    this.create_seccessfuly = 'task had been created',
                        this.taskData = {
                            title:'',
                            date:'',
                            time:'',
                            detail:'',
                        }
                });
            }else {
                console.log('you have to complate the fields')
            }
        },//end Update Task
        EditTask(item){
            this.taskData = {
                id:item.id,
                title: item.title,
                date: item.date,
                time: item.time,
                detail: item.detail,
            }
            this.taskErrors ={
                title: false,
                date: false,
                time: false,
                detail: false,
            }

        },//end edittask
        storeTask(){

             this.taskData.title == "" ? this.taskErrors.title = true : this.taskErrors.title = false
            this.taskData.date == '' ? this.taskErrors.date = true : this.taskErrors.date = false
            this.taskData.time == '' ? this.taskErrors.time = true : this.taskErrors.time = false
            this.taskData.detail == '' ? this.taskErrors.detail = true :this.taskErrors.detail = false

            if(this.taskData.title && this.taskData.date && this.taskData.time && this.taskData.detail){

                 axios.post('/api/storeTask', this.taskData).then(response => {
                     console.log(response.data)
                 }).catch(errors => {
                    console.log('here is you problems'.errors)
                 }).finally(()=>{
                    this.create_seccessfuly = 'task had been created'
                    this.taskData = {
                        title:'',
                        date:'',
                        time:'',
                        detail:'',
                    }
                     this.getTasks()
                 });
            }else {
                console.log('you have to complate the fields')
            }
        },//end  store task

    }//end method
}
</script>
