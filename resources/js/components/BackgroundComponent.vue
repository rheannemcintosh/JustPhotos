<template>
    <div class="container">
        <div class="row">
            <div class="card-body">
                <img :src="'/storage/'+userBanner" width="120">
                <br>
                <form @submit.prevent="updateBannerPic" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="image" class="form-control" v-on:change="onImageChange">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: ['userid'],
        data() {
            return {
                image: '',
                userBanner: ''
            }
        },
        mounted(){
            this.getUserRecentBanner()
        },
        methods: {
            onImageChange(e){
                console.log(e)
                this.image = e.target.files[0];
            },
            updateBannerPic(){
                const config={
                    headers:{
                        "content-type":"multipart/form-data"
                    }
                }
                let formData = new FormData();
                formData.append('image', this.image);
                axios.post('/bg-pic', formData, config).then((
                    response)=>{
                        this.image='',
                        this.getUserRecentBanner()
                    }
                ).catch((error)=>{
                    alert('Unable to Update Profile Picture!')
                })
            },
            getUserRecentBanner(){
                axios.get('/user/banner/'+this.userid).then((response)=>{
                    this.userBanner = response.data.substr(7)
                }).catch((error)=> {
                    alert('error');
                })
            }
        }

    }
</script>
