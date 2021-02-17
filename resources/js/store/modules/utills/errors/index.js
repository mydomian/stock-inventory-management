import actions from './actions'
import mutations from './mutations'
import getters from './getters'



const state = {
	is_errors: false,
	errors:[]
}

export default{
	state,
	getters,
	actions,
	mutations

}