<template>
    <lodaer-component></lodaer-component>
<!--  Show Data -->
    <div class="row success_msg_box">
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">All together</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" @click="close_success_msg_box()" class="btn btn-tool">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    The body of the card
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div><!--    End  success_msg_box   -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tasks Page</h3>
                <router-link to="/create_tasks">
                    <Button type="info ivu-fr"><Icon type="ios-add-circle-outline" /> Add New</Button>
                </router-link>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Task Name</th>
                        <th>date & Time</th>
                        <th>description</th>
                        <th>Sub Tasks</th>
                        <th>Image</th>
                        <th>Show Sub Tasks</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody >
                    <tr v-for="(item,index) in getTasksData" :key="index">
                        <td>{{index + 1}}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.date }} | {{ item.time }}</td>
                        <td>{{ item.detail.length <= 20 ? item.detail : item.detail.substr(0,20) + '...' }}</td>
                        <td>{{item.sub_task.length}}</td>
                        <td class="text-center">
                            <a v-if="item.task_file" :href="`img/tasks/${item.task_file}`" target="_blank"><img :src="`img/tasks/${item.task_file}`" style="width: 150px;height:30px"></a>
                            <p v-if="!item.task_file">...</p>
                        </td>
                        <td class="ivu-text-center">
                            <router-link :to="{name: 'show_subTask', params: {id: item.id}}">
                                <Button type="warning">Show all sub Task</Button>
                            </router-link>
                        </td>
                        <td class="ivu-text-center">
                            <router-link :to="{name: 'edit_task', params: {id: item.id}}">
                                <Button type="primary" data-toggle="modal" data-target="#editTask" data-whatever="@mdo">Edit</Button>
                            </router-link>
                            <Button @click="removeTask(item)" type="error" class="ivu-ml">Delete</Button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Task Name</th>
                            <th>date & Time</th>
                            <th>description</th>
                            <th>Sub Tasks</th>
                            <th>Show Sub Tasks</th>
                            <th>Action</th>
                        </tr>
                    </tfoot><!--  table footer  -->
                </table><!--  End Table  -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!--  End Show Data Table -->

</template>
<script>
import axios from "axios";
// ################################################################## //
export default{
    setup:() => ({
        title:"All Tasks"
    }),
    data(){
        return{
            taskData:{
                id:'',
                title:'',
                date:'',
                time:'',
                detail:'',
                task_file:'',
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
    // ######### Methods ###########
    methods:{
        close_success_msg_box(){
            $(".success_msg_box").modal('hide')
        },
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

    }//end method
}
</script>
<style>
.success_msg_box{
    position: fixed;
    top: 20px;
    z-index: 1099;
    width: 200px;
    display: none;
}
.card.card-success{
   width:400px
}
</style>
