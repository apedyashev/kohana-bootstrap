New job created and paid
Contact info
Name: <?php echo $job->contact_info->name ?>
Email: <?php echo $job->contact_info->email ?>


Job Details
Posting Type: <?php echo $job->posting_type ?>
Organization Name: <?php echo $job->organization_name ?> <br/>
Job Type: <?php echo $job->type ?> <br/>
Job Title: <?php echo $job->title ?> <br/>
Location: <?php echo $job->location_str ?><br/>
Url To Job Description: <?php echo $job->job_url ?>  <br/>
About company: <?php echo $job->about_company ?><br/>


<?php if($job->posting_type == 'internal'): ?>
How to apply: <?php echo $job->internal_details->apply_email ?><br/>
HTML:  <?php echo $job->internal_details->content ?><br/>
<?php endif; ?>

You can approve or decline it here: <?php echo URL::site('admin') ?>
