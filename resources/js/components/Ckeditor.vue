<template>
    <div>
        <ckeditor id="ck" v-model="editorData" :editor-url="editorUrl" :config="editorConfig" lan="fa"></ckeditor>
    </div>
</template>

<script>
    import CKEditor from 'ckeditor4-vue';
    Vue.use( CKEditor );
    export default {
        props:['tag_name','value'],
        data() {
            return {
                editorUrl: "//cdn.ckeditor.com/4.14.1/full/ckeditor.js",
                editorData: '',
                editorConfig: {
                    filebrowserUploadUrl: "/admin/ckEditor?_token="+document.head.querySelector('meta[name="csrf-token"]').content,
                    filebrowserUploadMethod: 'form',
                    contentsLangDirection : 'rtl',
                    language : 'fa',
                }
            };
        },
        mounted :
            function () {
                document.querySelector('#ck>textarea').name = this.tag_name;

                if(this.value != undefined){
                    this.editorData = this.value;
                }
            },

    }
</script>
