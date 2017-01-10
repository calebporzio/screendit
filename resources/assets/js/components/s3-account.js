Vue.component('s3-account', {
    props: ['user'],

    data() {
        return {
        	showForm: false,
            form: new SparkForm({
                s3_bucket: '',
                s3_key: '',
                s3_secret: ''
            })
        };
    },

    computed: {
    	hasntAddedCredsYet() {
    		return ! (this.user.s3_bucket &&
    			this.user.s3_key &&
    			this.user.s3_secret);
    	}
    },

    mounted() {
        this.form.s3_bucket = this.user.s3_bucket;
        this.form.s3_key = this.user.s3_key;
        this.form.s3_secret = this.user.s3_secret;
    },


    methods: {
    	toggleForm() {
    		this.showForm = ! this.showForm;
    	},

    	edit() {
    		this.form.s3_secret = '';
    		this.toggleForm();
    	},

        save() {
            Spark.post('/api/s3-account', this.form)
                .then(response => {
                    swal('Success', 's3 Bucket Successfully Saved!', 'success');
                    window.location = response.redirect_url
                });
        }
    }
});
