<template>
    <div class="">
        <!-- Show All SubTasks  -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All tasks</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">

                        <div class="alert alert-danger alert-dismissible m-4 text-center show" v-show='getTasksData.length == "" '>there's no sub Task</div>
                        <table v-show='getTasksData.length != "" ? "thers no sub Tasks" : ""' class="table table-head-fixed table-hover text-nowrap text-center ">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(sub_task,index) in getTasksData" :class="`${deleteClass ? ' bg-danger' : ''}`" :key="index">
                                <td>{{ sub_task.id + 1 }}</td>
                                <td>{{ sub_task.title}}</td>
                                <td >
                                    <span :class="`font-weight-bold p-1 ${sub_task.status == 0 ? 'text-red' : 'text-green'}`">
                                         {{ sub_task.status == 0 ? "UnComplated" : "Complated"}}
                                    </span>
                                </td>
                                <td>{{ sub_task.detail}}</td>
                                <td>{{ sub_task.start_date}}</td>
                                <td>{{ sub_task.end_date}}</td>
                                <td class="ivu-text-center">
                                    <Button type="primary" @click="edit_Sub_Task(sub_task)"  data-whatever="@mdo">Edit</Button>
                                    <Button @click="removeSubTask(sub_task)" type="error" class="ivu-ml">Delete</Button>
                                    <Button v-if="sub_task.status == 0" @click="markAsComplate(sub_task)" type="success" class="ivu-ml">Mark as complate</Button>
                                    <Button v-if="sub_task.status == 1" @click="markAsInComplate(sub_task)" type="warning" class="ivu-ml">Mark as Incomplate</Button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--  End All Sub Task Table -->
        <div class="modal-footer">
            <router-link :to="{name: 'create_subTask', params: {id: id}}" >
                <Button type="danger" data-toggle="modal" class="btn btn-danger" data-target="#editTask" data-whatever="@mdo">Go Back</Button>
            </router-link>
            <router-link :to="{name: 'create_subTask', params: {id: id}}" >
                <Button type="primary" data-toggle="modal" class="btn btn-primary" data-target="#editTask" data-whatever="@mdo">create Sub Task</Button>
            </router-link>
        </div>

            <!--  update task  Model-->
            <div v-if="edit_Sub_Taskfunction">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskLabel">Edit Task | {{id}}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="edit_Sub_Taskfunction = false">&times;</span>
                    </button>
                </div>
                <div v-show="" class="modal-header">
                    <div class=""></div>
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
                                    <input type="date" class="form-control" name="date" v-model="taskData.start_date">
                                    <span class="text-danger" v-show="taskErrors.start_date">this field is require</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="time" class="col-form-label">Time:</label>
                                    <input type="time" class="form-control data" name="time" v-model="taskData.end_date">
                                    <span class="text-danger" v-show="taskErrors.end_date">this field is require</span>
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
                        <button type="button" @click="updateSubTask()" class="btn btn-primary" >Update Sub Task</button>
                    </div>
                </form>
            </div>
        <!-- /.card -->

    </div><!-- End Main Dev -->
</template>
<script >
export default{
    props:{
        id: {
            type: Number,
                required: true
        }
    },
    data(){
        return {
            edit_Sub_Taskfunction:false,
            deleteClass: false,
            getTasksData: {},
            taskData : {
                id          : '',
                title       : '',
                detail      : '',
                start_date  : '',
                end_date    : '',
            },
            taskErrors :{
                title       : false,
                start_date  : false,
                end_date    : false,
                detail      : false,
            },
        }
    },
    mounted() {
        this.getSubTasksData()
    },
    methods:{
        getSubTasksData(){
            axios.post('/api/getSubTasksData/' + this.id).then(response =>{
                this.getTasksData = response.data
                console.log('done')
            }).catch(errors =>{
                console.log('warning')
            })
        },
        edit_Sub_Task(sub_task){
            this.edit_Sub_Taskfunction = true;
            this.taskData.title = sub_task.title;
            this.taskData.start_date = sub_task.start_date;
            this.taskData.end_date = sub_task.end_date;
            this.taskData.detail = sub_task.detail;
            this.taskData.id = sub_task.id;
            console.log(this.sub_task.start_date);

        },
        updateSubTask(){
            console.log(this.taskData)
            axios.post('/api/updateSubTask/' + this.taskData.id, this.taskData).then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error)
            }).finally(()=>{
                this.getSubTasksData()
                this.edit_Sub_Taskfunction = false;
                this.create_seccessfuly = 'task had been created'
                    this.taskData = {
                        id          : '',
                        title       : '',
                        detail      : '',
                        start_date  : '',
                        end_date    : '',
                    }
            });
        },
        removeSubTask(removeSubTask){
            this.deleteClass = true;
            axios.post('/api/deleteSubTask/'+ removeSubTask.id ).then(response => {
                console.log(response);
                this.getSubTasksData()
                this.edit_Sub_Taskfunction = false;
                this.deleteClass = false;
            }).catch(error => {
                console.log(error);
            });
        },
        markAsComplate(sub_task){
            axios.post('/api/markSubTaskAsComplate/'+ sub_task.id).then(response =>{
                console.log(response);
                this.getSubTasksData()
            }).catch(errors => {
                console.log(errors);
            });
        },
        markAsInComplate(sub_task){
            axios.post('/api/markSubTaskAsInComplate/'+ sub_task.id).then(response =>{
                console.log(response);
                this.getSubTasksData()
            }).catch(errors => {
                console.log(errors);
            });
        }

    }//end method
}
</script>
