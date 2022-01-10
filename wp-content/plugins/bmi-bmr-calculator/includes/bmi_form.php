 <div class="panel-heading">
	 <h3 class="panel-title">Body Mass Index Calculator</h3>
 </div>
<div class="row">
	<div class="col-md-6 left_side_form">
           <div class="input-group usr_details text-left">
		      <td>Name *</td>
		      <input type="hidden" name="uVal" value="kg">
		      <input type="text"  placeholder="Your name" class="form-control" id="username" name="user_name" required>
		    </div>
	  	
	  	<div class="input-group usr_details text-left">
		      <td>Phone *</td>
		      <input type="text" placeholder="Mobile no"class="form-control" id="userphone" name="user_phone" required onkeypress="return only_numbers(event);">
		    </div>
	  	
	  	<div class="input-group usr_details text-left">
		      <td>Email *</td>
		      <input type="text" placeholder="Email id"class="form-control" id="useremail" name="user_email"  required  >
		      <span class="input-error" style="display: none;">Please Enter Valid Email.</span>
		 </div>
	    <div class="input-group usr_details text-left">
	      <td>Age *</td>
	      <input type="text" placeholder="Your age" class="form-control" id="userage" name="user_age" required onkeypress="return only_numbers(event);">
	    </div>
	    <p>Use this BMI calculator to check the adults in your family.</p>
	  </div>
   	 <div class="col-md-1 bmi_border">
   	 </div>
	  <div class="col-md-5 right_side-form">
	  	 <div class="panel-body gender">
		        <div class="btn-group " data-toggle="buttons">
				  <label class="btn btn-primary male">
				  	<img src="/wp-content/themes/twentytwenty/assets/images/Mask Group 1.svg">
				    <input type="radio" name="sexoption" id="option1" value="male" required> Male
				  </label>
				  <label class="btn btn-primary female">
				 	<img src="/wp-content/themes/twentytwenty/assets/images/Mask Group 2.svg">
				    <input type="radio" name="sexoption" id="option2" value="female" required> Female
				  </label>
				</div>
		 </div>
	  		<!--<div class="input-group">
		      <span class="input-group-addon" id="weight">Weight (kg)</span>
		      <input type="text" class="form-control" id="userweight" name="weight" required onkeypress="return only_numbers(event);">
		    </div>-->
		<div class="budget-wrap">
			<div class="budget">
				<div class="header">
					<div class="input-group">Weight(kg) <span class="pull-right"></span></div>
				</div>
				<div class="content">
					<input id="slider" type="range" class="js-range-slider" min="0" max="250"  onchange="myFunction(event)">
		    		<input id="textbox" class="textboxuser" type="text" class="form-control" name="weight" id="userweight" class="text"  style="width: 100%;"required onkeypress="return only_numbers(event)" onkeyup="setrange(event)">
		    		<span>kg</span>
				</div>
			</div>
		</div>
		 <div class="budget-wrap">
			<div class="budget">
				<div class="header">
					<div class="input-group">Height(cm) <span class="pull-right"></span></div>
				</div>
				<div class="content">
					<input id="slideruser" type="range" class="js-range-slider" min="0" max="200"   onchange="myFunctionuser(event)">
		    		<input id="textboxuser" type="text" class="form-control" name="height" id="userheight" class="text" style="width: 100%;"required onkeypress="return only_numbers(event)" onkeyup="setrangeuser(event)">
		    		<span>cm</span>
				</div>
			</div>
		</div>

			   <!--   <div class="input-group">
			      <span class="input-group-addon"  id="height">Height (cm)</span>
			      <input type="text" class="form-control" id="userheight"  name="height" required onkeypress="return only_numbers(event);">
			    </div>-->
		    <div class="bodyFat_cont" style="display:none;" >
				<small><input readonly="readonly" checked="checked" type="checkbox" name="calculateauto" id="calculateauto">Let the calculator extrapolate my body fat % based on entered data (BMI result) </small><br>
			</div>

		   <!--  <textarea class="form-control" rows="3" style="min-height:100px;" placeholder="notes to yourself..." name="descriptionB"></textarea> -->
		    <button type="submit" class="btn btn-default btn-large calcbtn bmi_btn">Calculate your BMI for free</button>
	  		<p><span>*</span> BMI = Body Mass Index</p>
	  </div>
	  <img class="drop-down" src="/wp-content/themes/twentytwenty/assets/images/drop-down.png">
	</div>
	