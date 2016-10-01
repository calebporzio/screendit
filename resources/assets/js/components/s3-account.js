Vue.component('s3-account', {
    props: ['user'],

    /**
     * The component's data.
     */
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


    /**
     * Bootstrap the component.
     */
    ready() {
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

        /**
         * Add the user's s3 bucket information.
         */
        save() {
            Spark.post('/api/s3-account', this.form)
                .then(() => {
                    swal('Success', 's3 Bucket Successfully Added!', 'success');
                    // vvv Cowards way out, I know...
                    window.location.reload();
                });
        },

        /**
         * Update the user's S3 creds.
         */
        update() {
        	Spark.post('/api/s3-account', this.form)
        	    .then(() => {
        	        swal('Success', 's3 Bucket Successfully Updated!', 'success');
        	        // vvv Cowards way out, I know...
        	        window.location.reload();
        	    });
        }
    }
});
