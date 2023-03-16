<?php echo $header; ?><?php echo $column_left; ?>
<?php ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
    
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
    <div class="col-md-6" style="<?php if(isset($account_response['account_name']) ){echo 'display:none';}?>">

             
                                <div class="form-group">
                                  <h3>Create an Account</h3>
                                </div>
                            

            <div class="panel panel-default">
                <div class="panel-body">

                    <form name="registration_form" id="registration_form" class="space-top" action="<?php $action;?>"
                          method="post">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name"
                                           placeholder="Full Name" type="text" maxlength="100"
                                           required="required">
                                </div>
                            </div>

                            <input type="hidden" name="api_form" id="api_form" value="account_creation">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control" name="company_name" id="company_name"
                                           placeholder="Company Name" type="text" maxlength="200" required="required">
                                </div>
                            </div>
			     <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control" name="phone" id="phone"
                                           placeholder="+1 Contact no with country code" type="text" maxlength="200">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" placeholder="Email"
                                           type="email" maxlength="150" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12 margin-b-20">
                                <div class="form-group">
                                    <input class="form-control col-sm-12" name="password" id="password"
                                           placeholder="Password" type="password" maxlength="50"
                                           required="required">
                                </div>
                            </div>

                            <div class="col-sm-2">
				<div class="form-group">
                                <select name="protocol" id="protocol" class="form-control" required>
                                    <option value="http://">http://</option>
                                    <option value="https://">https://</option>
                                </select>
			      </div>
                            </div>
                            <div class="col-sm-10 margin-b-20">
			      <div class="form-group">
                                <input class="form-control" name="site_url" id="site_url"
                                       placeholder="Site Url" type="text" maxlength="200"
                                       required="required">
			      </div>
                            </div>

                            <div class="col-sm-9 subdomain-title">
                                <input class="form-control" name="sub_domain" id="sub_domain"
                                       placeholder="accountname" type="text" maxlength="100"
                                       required="required">
                            </div>
                            <div class="form-group col-sm-3 subdomain">
                                .pushassist.com
                            </div>
			  <div style="margin-left:15px;">
                            <input type="submit" class="btn btn-primary" value="Create Account"></div>
                            <!-- Validation Response -->
                            <div class="response-holder"></div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6">

            
<div class="form-group">
                                  <h3>Provide API Key And Secret Key.</h3>
                                </div>
            <div class="panel panel-default">
                <div class="panel-body">

                    <form name="key_form" id="key_form" class="space-top" action="<?php $action;?>"
                          method="post">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_api_key" id="pushassist_api_key" value="<?php echo $pushassist_api_key; ?>"
                                       placeholder="API Key" type="text" maxlength="250"
                                       required="required">
                            </div>
                        </div>

                        <input type="hidden" name="api_form" id="api_form" value="appKey">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_secret_key" value="<?php echo $pushassist_secret_key; ?>"
                                       placeholder="Secret Key" type="text" maxlength="250">
                            </div>
                        </div>
		      
			

			<div style="margin-left:15px;">
                        <input type="submit" class="btn btn-primary" value="Submit"></div>
                        <!-- Validation Response -->
                        <div class="response-holder"></div>
                    </form>

                </div>
            </div>
	    <div>
		  <div class="form-group"><h3>How to get API Keys</h3>
		  </div>
	    <div class="panel-heading">
	    If you are an existing user of PushAssist you can find your api keys under your PushAssit control panel.To get your API and Secret<br/>
	    Keys login to your <strong>PushAssist Admin Control Panel</strong> and click <strong>Sites</strong>.Copy the API Key and Secret Keys from your control Panel and <br/>
	    paste above.Your account login details were sent to you at the time of signup. In case you have missed your account credentials.<br/>
	    please send us an email at support@pushassist.com containing your site url and we will send you your account credentials.</br></br>
	    <p>Please do not share your API and Secret keys with anyone.</p></div>
	 
 <div class="panel-heading" >
	    <p><strong>What is a GCM Key? How do I get export my subscribers, What if I want to switch to other
                            vendor.</strong></p>
<p class="margin-b-15 margin-t-15">At the time of installation, you have to provide your GCM (Google
                        Cloud Messaging) API Key for Chrome and Certificate Details for Safari that is used.</p>
<p>We need this information to export your subscriber’s ID’s. Please note that only premium accounts
                        can export the subscribers.</p>
</div>

	  </div>
        </div>



    </div><!-- -->
  </div>
</div>
<?php echo $footer; ?>