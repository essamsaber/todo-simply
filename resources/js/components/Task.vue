<template>
    <tr>
        <td>{{task.title}}</td>
        <td>{{task.priority}}</td>
        <td><button @click="deleteTask" class="btn btn-danger">Remove</button></td>
    </tr>
</template>

<script>
    export default{
        data(){
            return {

            }
        },
        props:["task"],
        methods: {
            deleteTask(){
                this.$emit("destroyTask", this.task.id);
            }
        }
    }
</script>

<style>

</style>