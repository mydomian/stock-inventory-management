import * as actions from '../../action-types'
import * as mutations from '../../mutation-types'
import Axios from 'axios'

export default{
	[actions.GET_BRANDS]({ commit }){
		Axios.get('/api/brands')
			.then(res=>{
				// console.log(res.data);
				if(res.data.success == true){
					// console.log(res.data);
					commit(mutations.SET_BRANDS, res.data.data)
				}
				
		})
		.catch(err=>{
			console.log(err.response)
		})
	}
}