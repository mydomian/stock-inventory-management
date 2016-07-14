<template>

<form @submit.prevent="submitForm" role="form" method="post">
    <showErrors></showErrors>
    <div class="row">
       <div class="col-lg-6">
            <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Create Product</h5><br>

                            <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category<span class="text-danger">*</span></label>
                                            <Select2 v-model="form.category_id" :options="categories" :settings="{ placeholder: 'Select category' }"/>
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Brand<span class="text-danger">*</span></label>
                                            <Select2 v-model="form.brand_id" :options="brands" :settings="{ placeholder: 'Select brand' }"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">SKU<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="form.sku" placeholder="Write sku">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="form.name" placeholder="Product name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Image<span class="text-danger">*</span></label>
                                        <input @change="selectImage" type="file" class="form-control" placeholder="Select image">
                                           
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cost Price($)<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="form.cost_price" placeholder="Select cost price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Retail Price($)<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="form.retail_price" placeholder="Select retail price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Year<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="form.year" placeholder="Select year (Ex: 2021)">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" v-model="form.description" placeholder="Write description (mix: 200)">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status<span class="text-danger">*</span></label>
                                            <select class="form-control" v-model="form.status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
                                </div>
                            

                        </div>
                    </div><!-- /.card -->
           
        </div>

        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Product Size</h5><br><br>
                            <div class="row mb-1" v-for="(item, index) in form.items" :key="index">
                                <div class="col-sm-4">
                                    <select class="form-control" v-model="item.size_id">
                                        <option value="">Select size</option>
                                        <option v-for="(size, index) in sizes" :key="index" :value="size.id">{{ size.size }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" v-model="item.location" placeholder="Location">
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" v-model="item.quantity" placeholder="Quantity">
                                </div>
                                <div class="col-sm-2">
                                    <button @click="itemDel(index)" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            <button @click="addItem" type="button" class="btn btn-sm btn-info mt-3"><i class="fa fa-plus"></i>Add item</button>
                        </div>    
            </div>
        </div>
    </div>
</form>
</template>

<script>
import store from '../../store';
import * as actions from '../../store/action-types';
import showErrors from '../utills/showErrors'
import { mapGetters } from 'vuex'
import Select2 from 'v-select2-component';


	export default{
        // declare Select2Component
        components: {
            Select2,
            showErrors
        },
        data() {
            return {
                form:{
                    category_id : '',
                    brand_id : '',
                    name : '',
                    sku : '',
                    image: '',
                    cost_price: 0,
                    retail_price: 0,
                    year: '',
                    description: '',
                    status: 1,
                    items:[
                        {
                            size_id:'',
                            location: '',
                            quantity:''
                        }
                    ]


                }
            }
        },

        computed:{
             ...mapGetters({
                  'categories': 'getCategories',
                  'brands': 'getBrands',
                  'sizes' : 'getSizes'
             
            })
        },

        mounted(){
            //get categories
            store.dispatch(actions.GET_CATEGORIES);
            //get brands
            store.dispatch(actions.GET_BRANDS);
            //get sizes
            store.dispatch(actions.GET_SIZES);
        },

        methods:{
            selectImage(e){
               this.form.image = e.target.files[0];
            },
            //addItem
            addItem(){
                let item = {
                    size_id:'',
                    location: '',
                    quantity:''
                }
                this.form.items.push(item)
            },
            itemDel(index){
                this.form.items.splice(index, 1)
            },

            submitForm(){

                let data = new FormData();
                data.append('category_id', this.form.category_id)
                data.append('brand_id', this.form.brand_id)
                data.append('sku', this.form.sku)
                data.append('name', this.form.name)
                data.append('image', this.form.image)
                data.append('cost_price', this.form.cost_price)
                data.append('retail_price', this.form.retail_price)
                data.append('year', this.form.year)
                data.append('description', this.form.description)
                data.append('status', this.form.status)
                data.append('items', JSON.stringify(this.form.items))

                store.dispatch(actions.ADD_PRODUCTS, data);
            }
        }
	}
</script>






