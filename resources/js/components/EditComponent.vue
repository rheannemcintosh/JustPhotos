<template>
	<div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        
		    <form enctype="multipart/form-data" @submit.prevent="updateAlbum">
			<div class="form-group">
			
				<label>Name of Album</label>
				<input type="text" name="name" class="form-control" maxlength="15" required="" v-model="editrecord.name">
				
			
			</div>
			<div class="form-group">
				<label>Description of Album</label>
				<textarea class="form-control"  maxlength="200" name="description" required="" v-model="editrecord.description"></textarea>
				
			</div>
			<div class="form-group">
				<label>Category of Album</label>
                <select class="form-control" name="category" v-model="editrecord.category_id">
                    <option v-for="(category,index) in categories" :key="index" :value="category.id">
                        {{category.name}}
                    </option>
                </select>
			</div>
			<div class="form-group">
				<label>Image of Album</label>
				<input type="file" name="image" class="form-control" v-on:change="onImageChange">
				
			</div>
			<div class="form-group">
				
				<button class="btn btn-secondary" type="submit">Update Album</button>
			</div>
			
		</form>



		      </div>
		  
		    </div>
		  </div>
		</div>

	</div>
</template>
<script type="text/javascript">
    export default {
        props: ['editrecord'],
        data() {
            return {
                categories:[],
				image:''
            }
        },
        created(){
            this.getCategories();
        },
        methods:{
			onImageChange(e){
				console.log(e)
				this.image = e.target.files[0];
			},
            getCategories(){
                axios.get('/api/categories').then((response)=>{
                    this.categories = response.data
                }).catch((error)=>{
                    alert('unable to fetch categories')
                })
            },
			updateAlbum() {
				const config={
                    headers:{
                        "content-type":"multipart/form-data"
                    }
                }
                let formData = new FormData();
                formData.append('image', this.image);
                formData.append('name', this.editrecord.name);
                formData.append('description', this.editrecord.description);
                formData.append('category_id', this.editrecord.category_id);
				formData.append("_method", "put");
				axios.post('/albums/'+this.editrecord.id+'/edit',
					formData, config).then((response)=>{
						$('#exampleModal').modal('hide');
						this.$emit('recordUpdated', response)
						Swal.fire({
							position: 'center',
							icon: 'success',
							title: 'Your album has been updated',
							showConfirmButton: false,
							timer: 1500
						})
					}).catch((error)=>{
						console.log(error)
					})
			}
        }
    }
</script>