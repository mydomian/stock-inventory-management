import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import Axios from 'axios'

export default{
	// product add
	[actions.SUBMIT_RETURNS]({ commit }, payload){
		Axios.post('/return-products', payload)
			.then(res=>{
				
				if(res.data.success == true){
					window.location.href="/return-products/history"
				}
			})
			.catch(err=>{
				 commit(mutations.SET_ERRORS, err.response.data.errors)
			})
	}
}