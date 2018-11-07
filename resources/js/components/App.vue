<template>
    <div class="app-component">
        <div class="vld-parent">
            <loading :active.sync="isLoading"
                     :is-full-page="fullPage"></loading>

        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Task Title</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <task-component v-for="task in tasks" :key="task.id" :task="task" @destroyTask="deleteTask"></task-component>
            <tr>
                <td><input v-model="task.title" type="text" class="form-control"></td>
                <td>
                    <select v-model="task.priority" class="form-control">
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                    </select>
                </td>
                <td><button @click="storeTask" class="btn btn-primary">Add</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import TaskComponent from "./Task.vue"
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default{
        data(){
            return {
                isLoading: false,
                tasks: [],
                task: {"title":"", "priority":""}
            }
        },
        components: {TaskComponent, Loading},
        methods: {
            doAjax() {
                this.isLoading = true;
                // simulate AJAX
                setTimeout(() => {
                    this.isLoading = false
                },700)
            },
            getTasks(){
                axios.get('/api/tasks').then((response) => {
                   response.data.forEach(task => {
                      this.tasks.push(task);
                   });
                }).catch((error) => {

                });
            },
            storeTask(){
                this.doAjax();
               if(this.checkInput()) {
                   axios.post('/api/tasks', this.task)
                   .then((response) => {
                       this.tasks.push(response.data);
                       this.task.title = "";
                   }).catch((error) => {

                   })
               }
            },
            checkInput(){
                this.doAjax();
              if(this.task.title && this.task.priority) return true;
            },
            deleteTask(id){
                this.doAjax();
                axios.delete(`/api/tasks/${id}`).then(()=>{
                    let index = this.tasks.findIndex(task => task.id === id);
                    this.tasks.splice(index,1);
                });
            }
        },
        created(){
            this.getTasks();
        }
    }
</script>

<style>

</style>