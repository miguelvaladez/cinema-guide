var Vue = require('vue');
Vue.use(require('vue-resource'));

new Vue({
	el: '#app',

	data: {
		cinemas: [],
		prev_page_url: undefined,
		next_page_url: undefined,
		selectedCinema: undefined
	},

	ready: function() {
		this.fetchCinemas();
	},

	methods: {
		fetchCinemas: function() {
			this.$http.get('api/v1/cinemas', function(response) {
				this.cinemas = response.data;
				this.next_page_url = response.next_page_url;
			});
		},
		// retrieve the data set from the passed in next/prev page url
		loadDataSet: function(url) {
			this.$http.get(url, function(response) {
				this.cinemas = response.data;
				this.next_page_url = response.next_page_url;
				this.prev_page_url = response.prev_page_url;
			});
		},
		setCinema: function(cinema) {
			// set the passed in cinema object instead of request it again
			this.selectedCinema = cinema;
			// then get the session times object for the cinema (movie obj is auto-retrieved)
			this.$http.get('api/v1/cinemas/' + cinema.id + '/sessions', function(response) {
				this.$set('sessions', response.data);
				console.log(this.selectedCinema);
			});
		},
		unsetCinema: function() {
			this.selectedCinema = undefined;
		}
	}
})