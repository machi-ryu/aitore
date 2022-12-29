<template>
    <div>
        <label class="form-label" for="datetime">日時</label>
        <input class="form-control" type="datetime-local" name="start_datetime" v-model="start" @change="inputDatetime">
        <input class="form-control" type="datetime-local" name="end_datetime" v-bind:value="value">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                value:""
            };
        },
        methods:{
            inputDatetime(){
                this.value = this.start
            }
        }
    }
</script>
