<template>
    <div>
        <table class="table table-image">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Upload</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(album, index) in albums" :key="album.id">
                    <th scope="row">
                        {{index+1}}
                    </th>
                    <td class="w-25">
                        <img :src="'/album/'+album.image" class="img-fluid img-thumbnail">
                    </td>
                    <td>{{album.name}}</td>
                    <td>{{album.description}}</td>
                    <td>{{album.category.name}}</td>
                    <td>
                        <a :href="'upload/images/'+album.id">
                            <button class="btn btn-success">Upload</button>
                        </a>
                    </td>
                    <td>
                        <button @click.prevent="edit(album.id)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button @click.prevent="deleteRecord(album.id)" type="button" class="btn btn-danger">
                            Delete
                        </button>
                    </td>               
                </tr>
            </tbody>

        </table>
        <edit :editrecord="records" @recordUpdated="recordUpdate"></edit>
    </div>
</template>

<script type="text/javascript">
    export default {
        data(){
            return {
                albums: [],
                records: []
            }
        },
        created() {
            axios.get('/getalbums').then((response)=>{
                this.albums = response.data
            }).catch((error)=>{
                console.log(error)
            })                
        },
        methods:{
            edit(id){
				axios.get('/api/albums/'+id).then((response)=>{
					this.records = response.data
				}).catch((error)=>{
					alert('unable to to fetch data')
				})
			},
            recordUpdate(response){
                this.albums = response.data
            },
            deleteRecord(id){
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
                        axios.delete('/albums/'+id+'/delete').then((response)=>{
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