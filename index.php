<?php require 'template/header.php'; ?>

    <!--This is the main content of the page.-->
    <div id="maincontent">
		
		<div id="sectionerror"></div>
	
        <form id="mainform" action="submission.php" method="post">

			<div id="toggle-container">

            <!--This is the part of the form with school info.-->
            <div id="schoolinfo" class="section-1"><h3>School Information</h3>
                <div class="form-group">
                    <label>School</label>
                    <input class="form-control" type="search"
					name="school" id="school" oninput="itemValidate('school', /./)" 
					placeholder="Search" required="required"/>
                </div>
                <div class="form-group">
                    <label>Division</label>
                </div>
                    <div class="col-md-4">
                        <h3>Division 1</h3>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lorem nunc, molestie quis interdum sed, consequat nec elit. Sed a sem sed nulla scelerisque efficitur. Nunc a libero hendrerit, mollis augue rutrum, blandit felis. Donec sed nibh metus. Nulla mollis enim vel turpis tristique blandit. Aenean volutpat maximus commodo. Nam bibendum pharetra neque, sed convallis nunc imperdiet id. Nunc dapibus mi nunc, at dignissim ante mattis eu.
                    </div>
                    <div class="col-md-4">
                        <h3>Division 2</h3>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lorem nunc, molestie quis interdum sed, consequat nec elit. Sed a sem sed nulla scelerisque efficitur. Nunc a libero hendrerit, mollis augue rutrum, blandit felis. Donec sed nibh metus. Nulla mollis enim vel turpis tristique blandit. Aenean volutpat maximus commodo. Nam bibendum pharetra neque, sed convallis nunc imperdiet id. Nunc dapibus mi nunc, at dignissim ante mattis eu.
                    </div>
                    <div class="col-md-4">
                        <h3>Division 3</h3>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lorem nunc, molestie quis interdum sed, consequat nec elit. Sed a sem sed nulla scelerisque efficitur. Nunc a libero hendrerit, mollis augue rutrum, blandit felis. Donec sed nibh metus. Nulla mollis enim vel turpis tristique blandit. Aenean volutpat maximus commodo. Nam bibendum pharetra neque, sed convallis nunc imperdiet id. Nunc dapibus mi nunc, at dignissim ante mattis eu.
                    </div>
                <div id="selectDiv">
                        <label>Select Division</label>
                        <select class="form-control" name="selectDivision">
                                <option>Division 1</option>
                                <option>Division 2</option>
                                <option>Division 3</option>
                        </select>
                </div>
                <div id="selectTesting">
                        <label>Select Testing Site</label>
		        <select  class="form-control" name="selectTestingSite">
		                <option>Placeholder</option>
		                <option>Placeholder</option>
		                <option>Placeholder</option>
                        </select>
                </div>

            </div><!--End School Info-->

            <!--This is the part of the form with team info.-->
            <div id="teaminfo" class="section-2">
				<h3>Mentor Information</h3>
						<input name="mentorcount" type="hidden" value="0"/>
						<!--<h4>Mentor 1</h4>-->
						<div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text"
                                name="mentorname-1" id="mentorname-1"
								oninput="itemValidate('mentorname-1', /./)"
								placeholder="John Doe" required="required"/>
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email"
                                name="mentoremail-1" id="mentoremail-1"
								oninput="itemValidate('mentoremail-1', /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)"
								placeholder="example@email.com" required="required"/>
                        </div>
						<div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="tel"
                                name="mentorphone-1" id="mentorphone-1"
								oninput="itemValidate('mentorphone-1', /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/)"
								placeholder="000-000-0000" required="required"/>
                        </div>
						<div id="mentorcontainer">
							<!--Added Mentors will go here-->
						</div>
				<button type ="button" class="btn btn-default" 
				id="mentorButton" onclick="addMentor()">Add Mentor</button>
            </div><!--End Team Info-->

            <!--This is the part of the form with payment info.-->
            <div id="paymentsection" class="section-3">
				<h3>Payment Information</h3>
                <div class="table-responsive">
				<p id="paymenterror" class="error"></p>
                    <table class="table">
                        <tr>
                            <td><label>Type</label></td>
                            <td><label>Qty</label></td>
                            <td><label></label></td>
                            <td><label>Price</label></td>
                        </tr>
                        <tr>
							<!-- Come back and change min/maxlength to take any input and check for correctness with JS-->
                            <td><label>Comprehensive</label></td>
							<td><input class="form-control" type="number" 
							name="comprehensiveQty" id="comprehensiveQty" 
							min="0" max="99" value ="0" oninput="itemValidate('comprehensiveQty', /^[0-9]{1,2}$/);
							updatePrice('comprehensive')"/></td>
                            
							<td><label>x $5 =</label></td>
							<td><input class="form-control" type="number" 
							name="comprehensivePrice" id="comprehensivePrice"
							min="0" max="99" value="0" readonly /></td>                     
                        </tr>
                        <tr>
                            <td><label>Algebra II w/Trig</label></td>
							<td><input class="form-control" type="number" 
							name="algebraIIQty" id="algebraIIQty"
							min="0" max="99" value="0" oninput="itemValidate('algebraIIQty', /^[0-9]{1,2}$/);
							updatePrice('algebraII')"/></td>
                            
							<td><label>x $5 =</label></td>
							<td><input class="form-control" type="number" 
							name="algebraIIPrice" id="algebraIIPrice"
							value="0" readonly /></td>                 
                        </tr>
                        <tr>
                            <td><label>Geometry</label></td>
							<td><input class="form-control" type="number" 
							name="geometryQty" id="geometryQty"
							min="0" max="99"  value="0" oninput="itemValidate('geometryQty', /^[0-9]{1,2}$/);
							updatePrice('geometry')"/></td>
                            
							<td><label>x $5 =</label></td>
							<td><input class="form-control" type="number" 
							name="geometryPrice" id="geometryPrice"
							value="0" readonly /></td>                      
                        </tr>
                        <tr>
                            <td><label>School Fee</label></td>
							<td><input class="form-control" type="number" 
							name="schoolFeeQty" id="schoolFeeQty"
							value="1" readonly /></td>
                            
							<td><label>x $10 =</label></td>
							<td><input class="form-control" type="number" 
							name="schoolFeePrice" id="schoolFeePrice"
							value="10" readonly /></td>                      
                        </tr>
                        <tr>
                            <td><label>Total</label></td>
                            <td><label></label></td>
                            <td><label></label></td>
							<td><input class="form-control" type="number" 
							name="total" id="total" value="10" readonly /></td>                      
                        </tr>
                    </table>
                </div>            
            </div><!--End payment section-->
            
            </div><!--End #toggle-container-->

        </form>

    </div><!--End #maincontent-->

	<div id="register" class="form-group center">
		<h4 id="section-counter" class="center"></h4>
		<button id="back" class="btn btn-primary btn-lg" onclick="prevSection()">Back</button>
		<button id="next" class="btn btn-primary btn-lg" onclick="nextSection()">Next</button>
	</div>

<?php require 'template/footer.php'; ?>