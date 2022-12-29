<template>
<div>
    <input class="form-control" type="file" name="thumbnail" ref="preview" @change="show">
    <div class="preview-box" v-if="url">
        <img class="image-preview" v-bind:src="url">
    </div>
    <div class="preview-box" v-else>
        <img class="image-preview" src="/images/no_image.png">
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                message: "Try Preview!",
                url:""
            };
        },
        // mounted(){
        //     console.log(this.$refs.preview)
        // },
        methods:{
            show(){
                const file = this.$refs.preview.files[0];
                this.url = URL.createObjectURL(file);
            }
        }
    }
</script>
