<template>
    <div>
        <h3 class="text-left">
            <span v-if="editMode">Edit</span>
            <span v-else>New</span>
            Property
        </h3>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="editMode ? updateUser() : createUser()" enctype="multipart/form-data" @keydown="form.onKeydown($event)">
                            <!-- Alert -->
                            <alert-error :form="form"></alert-error>

                            <h5>Address Field</h5>

                            <div class="form-group">
                                <label>Address</label>
                                <input v-model="form.address" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                                <has-error :form="form" field="address"></has-error>
                                <!-- <input v-model="form.senderAddress.street" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('senderAddress.street') }">
                                <has-error :form="form" field="senderAddress.street"></has-error> -->
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label>Town</label>
                                        <input v-model="form.town" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('town') }">
                                        <has-error :form="form" field="town"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>County</label>
                                        <input v-model="form.county" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('county') }">
                                        <has-error :form="form" field="county"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Country</label>
                                        <input v-model="form.country" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                        <has-error :form="form" field="country"></has-error>
                                    </div>
                                </div>
                            </div>

                            <h5>Details</h5>

                            <div class="form-group">
                                <label>Title</label>
                                <select v-model="form.property_type_id" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('property_type_id') }" >
                                    <option v-for="option in propertyTypes" v-bind:value="option.id" >{{ option.title }}</option>
                                 </select>
                                <has-error :form="form" field="property_type_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="3" v-model="form.description" type="text"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" autocomplete="off"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" @change="handleFile">
                                <has-error :form="form" field="image"></has-error>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Latitude</label>
                                        <input v-model="form.latitude" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('latitude') }">
                                        <has-error :form="form" field="latitude"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Longitude</label>
                                        <input v-model="form.longitude" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('longitude') }">
                                        <has-error :form="form" field="longitude"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>No of Bedrooms</label>
                                        <input v-model="form.num_bedrooms" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('num_bedrooms') }">
                                        <has-error :form="form" field="num_bedrooms"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>No of Bathrooms</label>
                                        <input v-model="form.num_bathrooms" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('num_bathrooms') }">
                                        <has-error :form="form" field="num_bathrooms"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label>Type</label>
                                        <input v-model="form.type" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                        <has-error :form="form" field="type"></has-error>
                                    </div>
                                    <div class="col">
                                        <label>Price</label>
                                        <input v-model="form.price" type="text"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                                        <has-error :form="form" field="price"></has-error>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" v-if="editMode">
                                <div class="row">
                                    <div class="col">
                                        <router-link to="/" class="btn btn-outline-dark me-2" >Cancel </router-link>
                                        <button type="button" class="btn btn-dark " @click="updateProperty">Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" v-else>
                                <div class="row">
                                    <div class="col">
                                        <router-link to="/" class="btn btn-outline-dark me-2" >Cancel </router-link>
                                        <button type="button" class="btn btn-dark " @click="saveProperty">Save</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card" v-if="preview">
                    <div class="card-body">
                        <img :src="preview" class="rounded mx-auto d-block img-thumbnail">
                        <h5 class="card-title text-center mt-3">Preview</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { HasError, AlertError } from 'vform/src/components/bootstrap5'

    export default{
        name:"PropertyForm",
        components:{
            HasError,
            AlertError,
        },
        data(){
            return{
                editMode: Boolean(this.$route.params.id),
                baseUrl: import.meta.env.VITE_API_URL,
                preview: null,
                propertyTypes: [],
                form: new Form({
                    uuid: '',
                    county: '',
                    country: '',
                    town: '',
                    description: '',
                    address: '',
                    latitude: '',
                    longitude: '',
                    num_bedrooms: '',
                    num_bathrooms: '',
                    price: '',
                    type: '',
                    property_type_id: '',
                    image: null,
                    // senderAddress: {
                    //     id: '',
                    //     street: '',
                    //     city: '',
                    //     postcode: '',
                    //     country: ''
                    // },
                }),
            }
        },
        created(){
            if (this.$route.params.id) {
                this.getProperty();
            }
            else {
                this.addForm();
            }
            // property types
            this.getPropertyType();
        },
        methods:{
            addForm () {
                this.form.reset();
                this.form.clear();
                this.editMode = false;
            },
            editForm (data) {
                this.form.reset();
                this.form.clear();
                this.form.fill(data);
                this.preview = data.image_thumbnail;
                this.editMode = true;
            },
            handleFile(e) {
                this.form.image = e.target.files[0];
                this.preview = URL.createObjectURL(this.form.image);
            },
            async saveProperty() {
                await this.form.post(this.baseUrl+'/properties')
                .then(({ data }) => { 
                    Toast.fire({ icon: 'success', title: 'Property created successfully' });
                    this.$router.push('/');
                })
                .catch((error)=>{
                    Swal.fire('Failed!', 'Something went wrong.', 'warning');
                });
            },
            async updateProperty() {
                var URL = this.baseUrl+'/properties-edit/' + this.form.uuid; 
                await this.form.post(URL)
                .then(({ data }) => { 
                    Toast.fire({ icon: 'success', title: 'Property updated successfully' });
                    this.$router.push('/');
                })
                .catch((error)=>{
                    Swal.fire('Failed!', 'Something went wrong.', 'warning');
                });
            },
            async getProperty() {
                await axios.get(`${this.baseUrl}/properties/${this.$route.params.id}`).then((res)=> {
                    this.editForm(res.data)
                });
            },
            async getPropertyType() {
                await axios.get(`${this.baseUrl}/properties-types`).then((res)=> {
                    this.propertyTypes = res.data || []
                });
            },

        }
    } 
</script>