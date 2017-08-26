<?php echo validation_errors('<div class="error">', '</div>'); ?>
<?php if($this->session->flashdata('error')){ ?>
<div class='error'><?php echo $this->session->flashdata('error')?></div>
<?php } ?>
<?php echo form_open_multipart('admin/report',array('role'=>"form",'class'=>'form-horizontal'))?>
<h2>Create report</h2>
<fieldset>
	<legend></legend>
	<div class="form-group">
		<label class="control-label col-sm-3">Patient Type</label>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-4">
					<label class="radio-inline"> <input type="radio" name='patientType'
						class='patientType' checked
						value="<?php echo Patients_model::EXISTING_PATIENT ?>">Existing
					</label>
				</div>
				<div class="col-sm-4">
					<label class="radio-inline"> <input type="radio"
						class='patientType' name='patientType'
						value="<?php echo Patients_model::NEW_PATIENT ?>">New
					</label>
				</div>
			</div>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>Patient details:</legend>
	<div id='newPatientDetails'>
		<div class="form-group">
			<label for="first_name" class="col-sm-3 control-label">First Name</label>
			<div class="col-sm-9">
				<input type="text" id="first_name" placeholder="First Name"
					class="form-control" autofocus name='first_name'>
			</div>
		</div>
		<div class="form-group">
			<label for="last_name" class="col-sm-3 control-label">Last Name</label>
			<div class="col-sm-9">
				<input type="text" id="first_name" placeholder="Last Name"
					class="form-control" autofocus name='first_name'>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="email" name="email" placeholder="Email"
					class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="phone" class="col-sm-3 control-label">Mobile</label>
			<div class="col-sm-9">
				<input type="number" id="phone" name='phone' placeholder="Mobile no"
					class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="date_of_birth" class="col-sm-3 control-label">Date of
				Birth</label>
			<div class="col-sm-9">
				<input type="date" id="date_of_birth" name='date_of_birth'
					class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="address" class="col-sm-3 control-label">Address</label>
			<div class="col-sm-9">
				<textarea class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Gender</label>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-4">
						<label class="radio-inline"> <input type="radio" id="femaleRadio"
							value="Female">Female
						</label>
					</div>
					<div class="col-sm-4">
						<label class="radio-inline"> <input type="radio" id="maleRadio"
							value="Male">Male
						</label>
					</div>
					<div class="col-sm-4">
						<label class="radio-inline"> <input type="radio"
							id="uncknownRadio" value="Unknown">Unknown
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id='existingPatientDetails'>
		<div class="form-group">
			<label for="patientId" class="col-sm-3 control-label">Select Patient</label>
			<div class="col-sm-9">
				<select class="form-control" name="patient_id">
						<?php foreach ($patients as $patient){?>
						<option value="<?php echo $patient['id']?>"><?php echo formatPatientNumber($patient['id']).'/'.formatPatientName($patient['first_name'], $patient['last_name']) ;?></option>
						<?php }?>
					</select>
			</div>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>Report details:</legend>
	<div class="form-group">
		<label for="report_id" class="col-sm-3 control-label">Report Type</label>
		<div class="col-sm-9">
			<select class="form-control" name="report_id" id="report_id">
						<?php foreach ($reports as $report){?>
						<option value="<?php echo $report['id']?>"><?php echo $report['name'] ;?></option>
						<?php }?>
					</select>
		</div>
	</div>
	<div class="form-group">
		<label for="report_id" class="col-sm-3 control-label">Test Type</label>
		<div class="col-sm-9">
			<select class="form-control" name="report_id" id="report_id">
						<?php foreach ($reports as $report){?>
						<option value="<?php echo $report['id']?>"><?php echo $report['name'] ;?></option>
						<?php }?>
					</select>
		</div>
	</div>
</fieldset>

<div class="form-group">
	<div class="col-sm-9 col-sm-offset-3">
		<button type="submit" class="btn btn-primary btn-block">Register</button>
	</div>
</div>
</form>
<!-- /form -->

<script src="/assets/js/reports.js" type="text/javascript"></script>