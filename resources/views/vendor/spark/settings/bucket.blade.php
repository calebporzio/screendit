<s3-account :user="user" inline-template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">S3 Account</div>

            <div class="panel-body">
                <!-- Success Message -->
                <div class="alert alert-success" v-if="form.successful">
                    Your credentials have been saved!
                </div>

                <form class="form-horizontal" role="form">
                	<!-- Bucket -->
                	<div class="form-group" :class="{'has-error': form.errors.has('bucket')}">
                	    <label class="col-md-4 control-label">S3 Bucket Name</label>

                	    <div class="col-md-6">
                	        <input type="text" class="form-control" name="bucket" v-model="form.bucket">

                	        <span class="help-block" v-show="form.errors.has('bucket')">
                	            @{{ form.errors.get('bucket') }}
                	        </span>
                	    </div>
                	</div>

                	<!-- Directory -->
                	<div class="form-group" :class="{'has-error': form.errors.has('directory')}">
                	    <label class="col-md-4 control-label">Screenshot Directory</label>

                	    <div class="col-md-6">
                	        <input type="text" class="form-control" name="directory" v-model="form.directory">

                	        <span class="help-block" v-show="form.errors.has('directory')">
                	            @{{ form.errors.get('directory') }}
                	        </span>
                	    </div>
                	</div>

                    <!-- API Key -->
                    <div class="form-group" :class="{'has-error': form.errors.has('key')}">
                        <label class="col-md-4 control-label">API Key</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="key" v-model="form.key">

                            <span class="help-block" v-show="form.errors.has('key')">
                                @{{ form.errors.get('key') }}
                            </span>
                        </div>
                    </div>

                    <!-- API Secret -->
                    <div class="form-group" :class="{'has-error': form.errors.has('secret')}">
                        <label class="col-md-4 control-label">Secret Key</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="secret" v-model="form.secret">

                            <span class="help-block" v-show="form.errors.has('secret')">
                                @{{ form.errors.get('secret') }}
                            </span>
                        </div>
                    </div>

                    <!-- Update Button -->
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-6">
                            <button type="submit" class="btn btn-primary"
                                    @click.prevent="update"
                                    :disabled="form.busy">

                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</s3-account>