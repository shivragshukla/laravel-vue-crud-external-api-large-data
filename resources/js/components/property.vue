<template>
    <div>
    	<div class="row mb-4">
		  	<div class="col-8">
		        <h2 class="text-left">Properties List</h2>
		        <h6>There are {{properties.length}} total properties</h6>
		  	</div>
	  		<div class="col-4 float-end text-end">
        		<router-link to= "/create" class="btn btn-primary float-right" >Create </router-link>
	  		</div>
		</div>
		<div class="card-body">
            <div class="table-responsive mb-2">
		        <table class="table table-hover">
		            <thead class="table-dark">
		                <tr>
		                    <th>ID</th>
		                    <th width="150">Image</th>
		                    <th width="250">Number</th>
		                    <th width="250">Title</th>
		                    <th width="250">Description</th>
		                    <th width="200">Address</th>
		                    <th width="200">Location</th>
		                    <th>Type</th>
		                    <th>Bedrooms</th>
		                    <th>Price</th>
		                    <th width="150">Created</th>
		                    <th>Actions</th>
		                </tr>
		            </thead>
		            <tbody >
		                <tr v-for="(property, index) in properties.data" :key="property.id">
		                    <td>{{ currentPage + index}}</td>
		                    <td><img :src="property.image_thumbnail" :alt="property.property_type.title" class="img-thumbnail"></td>
		                    <td><code>{{ property.uuid}}</code></td>
		                    <td>{{ property.property_type.title }}</td>
		                    <td>{{ $filters.subString(property.description) }}</td>
		                    <td>{{ property.address }}</td>
		                    <td>{{ property.town + ", "+ property.country }}</td>
		                    <td>{{ property.type }}</td>
		                    <td class="text-center">{{ property.num_bedrooms }}</td>
		                    <td>{{ property.price }}</td>
		                    <td>{{ $filters.dateFormat(property.created_at) }}</td>
		                    <td>
		                        <div class="btn-group" role="group">
		                            <router-link :to="{name: 'edit', params: {id: property.uuid}}" class="btn btn-outline-dark me-2">Edit</router-link>
                                    <button type="button" class="btn btn-dark " @click="deleteProperty(property)">Delete</button>

		                        </div>
		                    </td>
		                </tr>
		            </tbody>
		        </table>
		    </div>
            <pagination 
            	align="center" 
            	:limit=5
            	:data="properties"
            	@pagination-change-page="getProperties"
        	>	
            	<template #prev-nav>
			        <span>&lt; Previous</span>
			    </template>
			    <template #next-nav>
			        <span>Next &gt;</span>
			    </template>
            </pagination>
		</div>
    </div>
</template>

<script>
    import pagination from 'laravel-vue-pagination'
    import axios from 'axios'
	import Moment from 'moment'

    export default{
        name:"Property",
        components:{
            pagination
        },
        data() {
            return {
                properties:[],
            }
        },
        computed: {
		 	currentPage() {
		    	return this.properties.from
		  	}
		},
        created(){
            this.getProperties();
        },
        methods:{
        	async getProperties(page=1){
                await axios.get(`/api/properties?page=${page}`).then(({data})=>{
                    this.properties = data
                }).catch(({ response }) => {
                    console.error(response)
                })
            },
            deleteProperty(property){
            	Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.isConfirmed) {
				  	this.delete(property);
				  }
				})
            },
            async delete(property) {
                await axios.delete(`/api/properties/${property.uuid}`).then(({data})=>{
				    Swal.fire('Deleted!', 'Your property has been deleted.', 'success')
                    this.getProperties()
                }).catch(({ response }) => {
                    console.error(response)
                })
            },
        }
    } 
</script>