<template>
    <lodaer-component></lodaer-component>

    <!--  Show Data -->
    <div>
        <div class="card">
            <!--  update task  Model-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskLabel">Edit Task | {{id}}</h5>
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
                                    <input type="text" class="form-control" name="title" v-model="getTasksData.title">
                                    <span class="text-danger" v-show="taskErrors.title">this field is require</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date" class="col-form-label">Date:</label>
                                    <input type="date" class="form-control" name="date" v-model="getTasksData.date">
                                    <span class="text-danger" v-show="taskErrors.date">this field is require</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="time" class="col-form-label">Time:</label>
                                    <input type="time" class="form-control" name="time" v-model="getTasksData.time">
                                    <span class="text-danger" v-show="taskErrors.time">this field is require</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail" class="col-form-label">detail:</label>
                                    <textarea class="form-control" rows="3" name="detail" v-model="getTasksData.detail"></textarea>
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
        <!-- /.card -->
    </div>


</template>
<script>
import axios from "axios";
import {InputNumber} from "view-ui-plus";

export default{
    components: {InputNumber},
    setup:() => ({
        title:"All Tasks",
    }),
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    data(){
        return{
            id:this.id,
            getTasksData: {},
            create_seccessfuly : "",
            // taskData :{
            //     //id:"this.$route.query.id",
            //     title: 'item.title',
            //     date: 'item.date',
            //     time: 'item.time',
            //     detail: 'item.detail',
            // },
            taskErrors :{
                title: false,
                date: false,
                time: false,
                detail: false,
            },
        }//end return
    },
    created() {
        // props are exposed on `this`
        console.log(this.id)
    },
    mounted() {
        this.getTasks()
    },//end mounted
    methods:{
        getTasks(){
            window.emitter.emit('changeLoadingStatus',true)
            axios.post('/api/getTaskDataToUpdate/' + this.id).then(res =>{
                this.getTasksData = res.data
                window.emitter.emit('changeLoadingStatus',false)
            }).catch(errors=>{
                console.log("we have some problems bro,it's like that: " + errors)
            })
        },
        updateTask(){
            if(this.getTasksData.title && this.getTasksData.date && this.getTasksData.time && this.getTasksData.detail){

                axios.post('/api/updateTask/'+ this.id, this.getTasksData).then(response => {
                    this.getTasks()
                }).catch(errors => {
                    console.log('here is you problems' + errors)
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


    }//end method
}
</script>
