<s3-account :user="user" inline-template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">S3 Account</div>

            <div class="panel-body">
                <!-- Error Message -->
                <div class="alert alert-danger" v-if="form.errors.hasErrors()">
                    <p v-text="error" v-for="error in form.errors.flatten()"></p>
                </div>
				
				<div v-if="showForm || hasntAddedCredsYet">
					<a href="#" class="text-danger pull-right" @click.prevent="toggleForm" v-if="! hasntAddedCredsYet"><i class="fa fa-fw fa-close"></i></a>

					<!-- Create / Update Form -->
	                <form class="form-horizontal" role="form">
						
						<div class="p-t-lg">
							<div class="alert alert-info">
								<p>
									<strong><a href="/s3-guide" target="_blank">Click Here</a></strong> for instructions on how to configure your AWS account for use with screendit.
								</p>
							</div>
						</div>

	                	<!-- Bucket -->
	                	<div class="form-group" :class="{'has-error': form.errors.has('s3_bucket')}">
	                	    <label class="col-md-4 control-label">S3 Bucket</label>

	                	    <div class="col-md-6">
	                	        <input type="text" class="form-control" name="s3_bucket" v-model="form.s3_bucket">
	                	    </div>
	                	</div>

	                    <!-- API Key -->
	                    <div class="form-group" :class="{'has-error': form.errors.has('s3_key')}">
	                        <label class="col-md-4 control-label">API Key</label>

	                        <div class="col-md-6">
	                            <input type="text" class="form-control" name="s3_key" v-model="form.s3_key">
	                        </div>
	                    </div>

	                    <!-- API Secret -->
	                    <div class="form-group" :class="{'has-error': form.errors.has('s3_secret')}">
	                        <label class="col-md-4 control-label">Secret Key</label>

	                        <div class="col-md-6">
	                            <input type="text" class="form-control" name="s3_secret" v-model="form.s3_secret">
	                        </div>
	                    </div>

	                    <!-- Update Button -->
	                    <div class="form-group">
	                        <div class="col-md-offset-4 col-md-6">
	                            <button type="submit" class="btn" :class="form.errors.hasErrors() ? 'btn-danger' : 'btn-primary'"
	                                    @click.prevent="save"
	                                    :disabled="form.busy">
	                                <span v-if="hasntAddedCredsYet">Save</span>
	                                <span v-else="hasntAddedCredsYet">Save</span>

	                                <span v-if="form.busy">&nbsp<i class="fa fa-circle-o-notch fa-spin"></i></span>
	                            </button>
	                        </div>
	                    </div>
	                </form>
					
				</div>

				<div v-else>
					<div class="pull-right">
						<button class="btn btn-warning" @click="edit"><i class="fa fa-edit"></i> Edit</button>
					</div>

					<dl class="dl-horizontal">
					  <dt>Bucket</dt>
					  <dd>@{{ user.s3_bucket }}</dd>
					  <dt>Key</dt>
					  <dd>@{{ user.s3_key }}</dd>
					  <dt>Secret</dt>
					  <dd>@{{ user.s3_secret }}</dd>
					</dl>
				</div>
				
            </div>
        </div>
    </div>
</s3-account>