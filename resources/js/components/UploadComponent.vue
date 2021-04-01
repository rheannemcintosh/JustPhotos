<template>
    <div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group files text-center" ref="fileform">
                <input type="file" ref="file" multiple="multiple">
                <span id="val"></span>
                <a class="btn btn-secondary" @click.prevent="submitFiles()">Upload</a>
            </div>
        </form>
    </div>
</template>

<script type="text/javascript">
    export default{
        data(){
            return{

            }
        },
        methods:{
            submitFiles(){
                alert("ok")
            }
        }
    }
</script>