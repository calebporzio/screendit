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

    mounted() {
        hljs.initHighlightingOnLoad();
    },

    computed: {
        isTrial() {
            return (new Date(this.user.trial_ends_at)) > (new Date())
        },

        isOutOfTrialRequests() {
            return this.user.requests_this_period >= 25;
        },

        periodStart() {
            return moment(this.user.period_start_date).add(1, 'month').format('MMM Do');
        }
    }
});
