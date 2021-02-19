import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import Axios from 'axios'

export default{
	// product add
	[actions.ADD_PRODUCTS]({ commit }, payload){
		Axios.post('/products', payload)
			.then(res=>{
				
				if(res.data.success == true){
					window.location.href="/products"
				}
			})
			.catch(err=>{
				 commit(mutations.SET_ERRORS, err.response.data.errors)
			})
	},
	// product update
	[actions.EDIT_PRODUCTS]({ commit }, payload){
		Axios.post(`/products/${payload.id}`, payload.data)
			.then(res=>{
				
				if(res.data.success == true){
					window.location.href="/products"
				}
			})
			.catch(err=>{
				 commit(mutations.SET_ERRORS, err.response.data.errors)
			})
	}
}