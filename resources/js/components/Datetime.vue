<template>
    <div>
        <label class="form-label" for="datetime">日時</label>
        <span class="ms-3 text-danger">{{ errorMessage }}</span>
        <input
            class="form-control"
            :class="{ 'is-invalid': isInvalidStart }"
            type="datetime-local"
            name="start_datetime"
            step="900"
            v-model="start"
            @change="inputDatetime">
        <input
            class="form-control"
            :class="{ 'is-invalid': isInvalidEnd }"
            type="datetime-local"
            name="end_datetime"
            v-model="end">
    </div>
</template>

<script>
    export default {
        name: 'Datetime',
        props: ['start', 'end', 'isInvalidStart', 'isInvalidEnd', 'errorMessage'],
        data() {
            return {
                // start:""
                // value:"",
                end: this.end,
            };
        },
        methods:{
            inputDatetime(){
                this.end = this.start
            }
        }
    }
</script>
