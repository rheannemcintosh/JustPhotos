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
                        <button @click.prevent="edit(album.id)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">

                        </button>
                    </td>                
                </tr>
            </tbody>

        </table>
        <edit></edit>
    </div>
</template>

<script type="text/javascript">
    export default {
        data(){
            return {
                albums: []
            }
        },
        created() {
            axios.get('/getalbums').then((response)=>{
                this.albums = response.data
            }).catch((error)=>{
                consol.log(error)
            })                
        },
        methods:{
            edit(id) {
            }
        }
    }
</script>