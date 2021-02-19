<template>

<form @submit.prevent="submitForm" role="form" method="post">
    <showErrors></showErrors>
    <div class="row">
       <div class="col-lg-6">
            <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Return Manage</h5><br>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product<span class="text-danger">*</span></label>
                                        <Select2 @change="selectItem" v-model="form.product_id" :options="products" :settings="{ placeholder: 'Select products' }"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date<span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" v-model="form.date">
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
                            
                            <table class="table table-sm table-borderd">
                                <tr v-for="(item, index) in form.items" :key="index">
                                    <td>{{ item.size }}</td>
                                    <td><input v-model="item.quantity" class="form-control"></td>
                                </tr>
                            </table>
                           
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
                   
                    date:'',
                    product_id:'',
                    items:[
                        
                    ]


                }
            }
        },

        computed:{
             ...mapGetters({
                  'products' : 'getProducts'
                   
            })
        },

        mounted(){
            //get products
            store.dispatch(actions.GET_PRODUCTS);
        },

        methods:{
           selectItem(id){
              let product = this.products.filter(product=>product.id == id); 
              console.log(product)
              product[0].product_size_stock.map(stock=>{
                let item ={
                    size: stock.size.size,
                    size_id: stock.size_id,
                    quantity:''

                }
                this.form.items.push(item)
              })
              

           },
           submitForm(){
           
             store.dispatch(actions.SUBMIT_RETURNS, this.form)
           }
        }
    }
</script>






