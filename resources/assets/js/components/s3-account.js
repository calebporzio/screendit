Vue.component('s3-account', {
    props: ['user'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({
                bucket: '',
                directory: '',
                key: '',
                secret: ''
            })
        };
    },


    /**
     * Bootstrap the component.
     */
    ready() {
        this.form.bucket = this.user.s3_bucket;
        this.form.directory = this.user.s3_directory;
        this.form.key = this.user.s3_key;
        this.form.secret = this.user.s3_secret;
    },


    methods: {
        /**
         * Update the user's s3 bucket information.
         */
        update() {
            Spark.put('/api/s3-account', this.form)
                .then(() => {
                    swal('Success', 's3 Bucket Successfully Added!', 'success');
                });
        }
    }
});
