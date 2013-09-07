<h3>New job created and paid</h3>
<h4>Contact info:</h4>
<b>Name</b>: <?php echo $job->contact_info->name ?><br/>
<b>Email</b>: <?php echo $job->contact_info->email ?><br/>

<br/>
<br/>
<h4>Job Details:</h4>
<b>Posting Type</b>: <?php echo $job->posting_type ?><br/>
<b>Organization Name</b>: <?php echo $job->organization_name ?> <br/>
<b>Job Type</b>: <?php echo $job->type ?> <br/>
<b>Job Title</b>: <?php echo $job->title ?> <br/>
<b>Location</b>: <?php echo $job->location_str ?><br/>
<b>Url To Job Description</b>: <a href="<?php echo $job->job_url ?> "><?php echo $job->job_url ?> </a> <br/>
<b>About company</b>: <?php echo $job->about_company ?><br/>

<?php if($job->posting_type == 'internal'): ?>
<b>How to apply</b>: <?php echo $job->internal_details->apply_email ?><br/>
<b>HTML</b>:  <?php echo $job->internal_details->content ?><br/>
<?php endif; ?>
<hr/>

<br/>
<br/>
You can approve or decline it <a href="<?php echo URL::site('admin') ?>">here</a>

