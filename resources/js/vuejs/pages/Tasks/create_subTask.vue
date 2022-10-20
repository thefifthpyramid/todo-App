<template>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create subTask</h3>
            </div>

            <div class="alert alert-success alert-dismissible m-4 text-center show" v-show='create_successfully_msg'>create sub tasks successfully</div>

            <form method="post" action="./api/subTask" >
                <div class="modal-body">
                    <div class="row" v-for="(subTaskDataItem,index) in subTaskData" :key="index">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" name="title" v-model="subTaskDataItem.title">
                                <span class="text-danger" v-show="subTaskErrors[index].title">this field is require</span>
                            </div>
                        </div><!-- End Col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date" class="col-form-label">Date:</label>
                                <input type="date" class="form-control" name="date" v-model="subTaskDataItem.start_date">
                                <span class="text-danger" v-show="subTaskErrors[index].start_date">this field is require</span>
                            </div>
                        </div><!-- End Col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="time" class="col-form-label">Time:</label>
                                <input type="time" class="form-control" name="time" v-model="subTaskDataItem.end_date">
                                <span class="text-danger" v-show="subTaskErrors[index].end_date">this field is require</span>
                            </div>
                        </div><!-- End Col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="detail" class="col-form-label">detail:</label>
                                <input class="form-control" rows="3" name="detail" v-model="subTaskDataItem.detail">
                            </div>
                        </div><!-- End Col -->
                        <div class="col-md-2">
                            <div class="form-group text-center mt-4">
                                <button type="button" @click="removeSubTaskData(index)" class="btn btn-danger mr-2" v-if="subTaskData.length > 1 && index > 0">-</button>
                                <button type="button" @click="createSubTaskData()" class="btn btn-primary" >+</button>
                            </div>
                            <hr>
                        </div><!-- End Col -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                        <Button type="primary" @click="storeSubTask()" data-toggle="modal"  data-target="#editTask" data-whatever="@mdo">create Sub Task</Button>

                    </div>
                </div>

            </form>
        </div>
</template>

<script>
import axios from "axios";

export default {
    props:{
        id: {
            type: Number,
            required: true
        }
    },
    data(){
        return {
            create_successfully_msg: false,
            $id: this.id,
            getTasksData: {},
            subTaskData:[],
            subTaskErrors:[],
            sub_task:{}
        }
    },
    mounted() {
        this.showSubTasks()
    },//end mounted
    methods:{
        showSubTasks(){
            this.subTaskErrors = [{
                title: false,
                start_date: false,
                end_date: false,
            }];
            this.sub_task = this.id.sub_task
            this.subTaskData = [{
                id:'',
                task_id: this.id,
                title: '',
                detail: '',
                start_date:'',
                end_date:''
            },
            ];
        },//show sub tasks
        createSubTaskData(){
            this.subTaskData.push({
                id:'',
                task_id: this.subTaskData[0].task_id,
                title: '',
                detail: '',
                start_date:'',
                end_date:''
            });
            this.subTaskErrors.push({
                title: false,
                start_date: false,
                end_date: false,
            });
        },
        removeSubTaskData(index){
            this.subTaskData.splice(index,1)
            this.subTaskErrors.splice(index, 1)
        },

        storeSubTask (){
            for(let i = 0;i < this.subTaskData.length;i++){
                this.subTaskData[i].title == '' ? this.subTaskErrors[i].title = true : this.subTaskErrors[i].title = false
                this.subTaskData[i].start_date == '' ? this.subTaskErrors[i].start_date = true : this.subTaskErrors[i].start_date = false
                this.subTaskData[i].end_date == '' ? this.subTaskErrors[i].end_date = true : this.subTaskErrors[i].end_date = false
            }
            const result = this.subTaskData.every(subTask =>{
                return subTask.title && subTask.start_date && subTask.end_date
            });
            if(result){
                window.emitter.emit('changeLoadingStatus',true)
                const t = this
                //setTimeout(function (){
                axios.post('/api/storeSubTask', this.subTaskData).then(response => {
                    //this.getTasks()
                    console.log('hi from all task show: ' + response)
                    window.emitter.emit('changeLoadingStatus',false)
                    $("#sub_TaskModal").modal('hide')
                    $(".success_msg_box").modal('show')
                }).catch(errors => {
                    console.log(errors)
                    window.emitter.emit('changeLoadingStatus',true)
                }).finally(()=> {
                    this.create_successfully_msg = true,
                    this.subTaskData = [{
                        id:'',
                        task_id: this.id,
                        title: '',
                        detail: '',
                        start_date:'',
                        end_date:''
                    },];
                });
                //},500);
            }else{
                console.log('if condition dosen" allow');
            }
        },

    }//end method
}
</script>
