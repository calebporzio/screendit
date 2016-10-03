Vue.component('home', {
    props: ['user'],

    data() {
    	return {
    		steps: [
    			{number: 1, text: 'Add Your S3 Credentials', cta: 'Add Them', link: '/settings#/bucket'},
    			{number: 2, text: 'Create an API Token', cta: 'Create One', link: '/settings#/api'},
    			{number: 3, text: 'Generate a Screenshot!', cta: 'See How', link: '/docs'}
    		]
    	}
    },

    ready() {
        //
    }
});
