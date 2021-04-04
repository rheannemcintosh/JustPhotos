<template>
    <div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group files text-center" ref="fileform">
                <input type="file" ref="file" multiple="multiple">
                <span id="val"></span>
                <a class="btn btn-secondary" @click.prevent="submitFiles()">Upload</a>
            </div>
        </form>
        <progress max="100" style="width: 100%;" :value.prop="uploadPercentage" v-if="uploading"></progress>

        <div class="container">
            <hr class="mt-2 mb-5">
            <div class="row text-center text-lg-left">
                <div class="col-lg-3 col-md-4 col-6" v-for="(image, index) in images" :key="index">
                    <a href="">
                        <img :src="'/images/'+image.image" class="img-fluid img-thumbnail">
                        <button class="btn btn-danger btn-small" @click.prevent="DeleteImage(image.id)">
                            Delete
                        </button>
                    </a>
                </div>
            </div>
        </div>
    
    </div>
</template>

<script type="text/javascript">
    export default{
        props: ['album_id'],
        data(){
            return{
                uploadPercentage: '',
                uploading: false,
                images: []
            }
        },
        mounted(){
            this.getImage()
        },

        methods:{
            submitFiles(){
                let formData = new FormData();
                for(var i=0; i < this.$refs.file.files.length; i++) {
                    let file = this.$refs.file.files[i];
                    formData.append('files['+i+']', file);
                    formData.append('album_id', this.album_id)
                }
                this.uploading = true;
                this.$refs.file.value = '';
                axios.post('/uploadImage', formData, {
                    headers:{
                        "content-type":"multipart/form-data"
                    },
                    onUploadProgress: function(progressEvent) {
                        this.uploadPercentage = parseInt(Math.round((
                            progressEvent.loaded*100)/progressEvent.total
                        ));
                    }.bind(this)

                }).then((response)=>{
                    this.getImage()
                })
            },
            getImage(){
                axios.get('/getimages'),then((response)=>{
                    this.images = response.data
                }).catch((error)=>{
                    alert('error')
                })
            },
            DeleteImage(id){
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result)=>{
                    if(result.value){
                        axios.delete('/image/'+id).then((response)=>{
                            this.getImage()
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your album has been deleted',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.albums = response.data
                        }).catch((error)=>{
                            console.log(error)
                        })
                    }
                })
            }
        }
    }
</script>