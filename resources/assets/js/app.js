var Vue = require('vue');
Vue.use(require('vue-resource'));

new Vue({
	el: '#app',

	data: {
		cinemas: [],
		prev_page_url: undefined,
		next_page_url: undefined,
		selectedCinema: undefined,
		searchTerm: '',
		searchResults: []
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
			});
		},
		unsetCinema: function() {
			this.selectedCinema = undefined;
		},
		search: function(e) {
			e.preventDefault();

			this.$http.get('api/v1/sessions/search?search=' + this.searchTerm, function(response) {
				if (response.data) {
					this.searchResults = response.data;
				} else {
					// no match found
					alert(response.message);
				}
			});
		},
		clearSearch: function() {
			this.searchTerm = '';
			this.searchResults = [];
		}
	}
})