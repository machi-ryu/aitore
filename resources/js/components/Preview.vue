<template>
<div>
    <label class="form-label">写真</label>
    <input class="form-control" type="file" name="thumbnail" ref="preview" @change="show">
    <div class="preview-box" v-if="url">
        <img class="image-preview" v-bind:src="url">
    </div>
    <div class="preview-box" v-else>
        <img class="image-preview" :src="image_path">
    </div>
</div>
</template>

<script>
    export default {
        name: 'Preview',
        props: ['image_path', 'previewPath'],
        data() {
            return {
                url:""
            };
        },
        mounted(){
            console.log(this.$refs.preview)
        },
        methods:{
            show(){
                const file = this.$refs.preview.files[0];
                this.url = URL.createObjectURL(file);
            }
        }
    }
</script>
