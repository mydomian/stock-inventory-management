<template>
	<div class="row">
		<div class="col-sm-12" v-if="isErrors">
			<div class="alert alert-danger" role="alert">
			  <ul v-for="(item, index) in errors" :key="index">
			  	<li>{{ item[0] }}</li>
			  </ul>
			</div>
		</div>
	</div>
</template>
<script>
import { mapGetters } from 'vuex'
	export default{
		name: 'showError',

		computed: {

		    ...mapGetters({
		    	isErrors : 'getIsErrors',
		    	errors : 'getErrors'
		    })
		 }

	}
</script>
<style scoped="">
	
</style>