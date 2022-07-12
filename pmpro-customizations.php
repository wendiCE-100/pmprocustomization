<?php
/*
Plugin Name: PMPro Customizations
Plugin URI: http://www.paidmembershipspro.com/wp-content/pmpro-customizations/
Description: Customizations for Paid Memberships Pro
Version: .1
Author: Stranger Studios
Author URI: http://www.strangerstudios.com
*/
//we have to put everything in a function called on init, so we are sure Register Helper is loaded
function my_pmprorh_init()
{
    //don't break if Register Helper is not loaded
    if(!function_exists("pmprorh_add_registration_field"))
    {
        return false;
    }

    //define the fields
    $fields = array();

if(is_user_logged_in()) {
   if (isset($_GET['level']) && ($_GET['level'] == 12 || $_GET['level'] == 11)) {
	wp_logout();
	header("Refresh:0");
      }
}


global $countries;
global $state_province;
global $supplier_categories;
global $offer_dates;
//$offer_date = array(' ' => ' ')  + $offer_dates;
$offer_date_open  = array(' ' => ' ','Open Dates' => 'Open Dates') + $offer_dates;
global $supplier_products;
$timezones = generate_timezone_list();
//asort($timezones);
$chapter_assoc_list = em_gen_chapter_assoc();
$chapters = array_map(function($item) { return $item['Chapter']; }, $chapter_assoc_list);
$chapters[" "] = " ";
ksort($chapters);


if(pmpro_hasMembershipLevel())
  {

$fields[] = new PMProRH_Field(
	"Notes", // input name, will also be used as meta key
	"html", 	 // type of field
	array(
	"label"=>"Note:",
	"html"=>'<p><strong>&nbsp;&nbsp;&nbsp;Please Verify Your Agency Information</strong></p>',
	"levels"=>[22]	// show for specific membership level
	));
}

$fields[] = new PMProRH_Field(
		"Supplier_Name",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36,51,52,53],		// show for specific membership level
			"label"=>"Supplier Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Representative_First_Name",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,36,51,52,53],		// show for specific membership level
			"label"=>"Representative First Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Representative_Last_Name",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,36,51,52,53],		// show for specific membership level
			"label"=>"Representative Last Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

// approved supplier list fields

$fields[] = new PMProRH_Field(
		"BDM_Name",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,36,51,52,53],		// show for specific membership level
			"label"=>"BDM Contact Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"BDM_Email",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,36,51,52,53],		// show for specific membership level
			"label"=>"BDM Email:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"BDM_Phone",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,36,51,52,53],		// show for specific membership level
			"label"=>"BDM Phone Number:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
                "BDM_Contact_File",              // input name, will also be used as meta key
                "file",                 // type of field
                array(
                        "size"=>40,         // input size
                        "profile"=>"only_admin",    // show in user profile
                        "required"=>false,    // make this field required
                        "levels"=>[7,19,20,26,36,51,52,53],           // show for specific membership level
                        "label"=>"BDM Contact File",
                        "memberslistcsv"=>false    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the $
                ));


$fields[] = new PMProRH_Field(
                "BDM_Offer_File",              // input name, will also be used as meta key
                "file",                 // type of field
                array(
                        "size"=>40,         // input size
                        "profile"=>"only_admin",    // show in user profile
                        "required"=>false,    // make this field required
                        "levels"=>[7,19,20,26,36,51,52,53],           // show for specific membership level
                        "label"=>"BDM Offer File",
                        "memberslistcsv"=>false    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the $
                ));

$fields[] = new PMProRH_Field(
                "BDM_Registration_File",              // input name, will also be used as meta key
                "file",                 // type of field
                array(
                        "size"=>40,         // input size
                        "profile"=>"only_admin",    // show in user profile
                        "required"=>false,    // make this field required
                        "levels"=>[7,19,20,26,36,51,52,53],           // show for specific membership level
                        "label"=>"BDM Registration File",
                        "memberslistcsv"=>false    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the $
                ));


$fields[] = new PMProRH_Field(
		"BDM_Boooking_Information",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>3,
			"columns"=>40,// input size
			"profile"=>"only_admin",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,36,51,52,53],		// show for specific membership level
			"label"=>"BDM Boooking Information:",
			"memberslistcsv"=>false    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Supplier_Commission",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,36,51,52,53],		// show for specific membership level
			"label"=>"Commission:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

// end approved supplier list fields

$fields[] = new PMProRH_Field(
		"TRUE_code_Accept",              // input name, will also be used as meta key
	 "select",                   // type of field
        array(
        	    "options"=>array(       // <option> elements for select field
        	    ""=>"",     // <option value=""> </option>
                	"Yes"=>"Yes",     // <option value="Yes">Yes</option>
		        "No"=>"No"),  // <option value="No">No</option>
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,36,51,52,53],		// show for specific membership level
			"label"=>"Does Your Company Accept The TRUE Code For Agency Verification?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"Supplier_Signup_Page",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,36,51,52,53],		// show for specific membership level
			"label"=>"Travel Agent Registration Page:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
        "Agent_First_Name",              // input name, will also be used as meta key
        "text",                 // type of field
        array(
            "size"=>40,         // input size
            "profile"=>true,    // show in user profile
            "required"=>true,    // make this field required
            "levels"=>[1,2,3,4,5,6,9,10,11,12,22,24,32,33,34,35,49,50],		// show for specific membership level
            "label"=>"First Name",
            "memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
        ));


	$fields[] = new PMProRH_Field(
        "Agent_Last_Name",              // input name, will also be used as meta key
        "text",                 // type of field
        array(
            "size"=>40,         // input size
            "profile"=>true,    // show in user profile
            "required"=>true,    // make this field required
            "levels"=>[1,2,3,4,5,6,9,10,11,12,22,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
            "label"=>"Last Name",
            "memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
        ));


    $fields[] = new PMProRH_Field(
        "Agency_Name",              // input name, will also be used as meta key
        "text",                 // type of field
        array(
            "size"=>40,         // input size
            "profile"=>true,    // show in user profile
            "required"=>true,    // make this field required
            "levels"=>[1,2,3,4,5,6,9,10,11,12,22,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
            "label"=>"Agency Name",
            "memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
        ));


	$fields[] = new PMProRH_Field(
		"Mailing_Address",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			 "levels"=>[2,3,4,5,6,7,9,10,11,12,19,20,22,23,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Mailing Address",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
		"Mailing_City",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			 "levels"=>[2,3,4,5,6,7,9,10,11,12,19,20,22,23,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Mailing City",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
		"Mailing_State_Province",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$state_province,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[2,3,4,5,6,7,9,10,11,12,19,20,22,23,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Mailing State Province",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

	$fields[] = new PMProRH_Field(
		"Mailing_Zip_Code",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[2,3,4,5,6,7,9,10,11,12,19,20,22,23,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Mailing Zip Code",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
		"Mailing_Country",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$countries,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[2,3,4,5,6,7,9,10,11,12,19,20,22,23,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Mailing Country",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
		"Business_Phone",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[2,3,4,5,6,7,9,10,11,12,19,20,22,23,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Business Phone",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

	$fields[] = new PMProRH_Field(
		"Mobile_Phone",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"label"=>"Mobile Phone",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

	$fields[] = new PMProRH_Field(
		"Website_URL",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[1,2,3,4,6,7,9,10,19,20,22,26,29,32,34,49,50,36,51,52,53],		// show for specific membership level
			"label"=>"Website URL",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
		"Years_Selling_Travel",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
                        "levels"=>[1,2,3,4,5,6,9,10,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Number of years you have been selling travel",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
				"Years_in_Business",              // input name, will also be used as meta key
				"text",                 // type of field
				array(
					"size"=>40,         // input size
					"profile"=>"only",    // show in user profile
					"required"=>false,    // make this field required
					"levels"=>[4,6,32,34,49,50],		// show for specific membership level
					"label"=>"Number of years the Company has been in business",
					"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
				));


    $fields[] = new PMProRH_Field(
        "Type_of_Business",              // input name, will also be used as meta key
         "select",                   // type of field
		        array(
		        	    "options"=>array(       // <option> elements for select field
		        	    ""=>"",     // <option value=""> </option>
		        "Sole Proprietor"=>"Sole Proprietor",     // <option value="Sole Proprietor">Sole Proprietor</option>
		        "LLC"=>"LLC",  // <option value="LLC">LLC</option>
		        "Corporation"=>"Corporation",  // <option value="Corporation">Corporation</option>
		        "Member of Host Agency"=>"Member of Host Agency"),  // <option value="Member of Host Agency">Member of Host Agency</option>
            "size"=>40,         // input size
            "profile"=>"only",    // show in user profile
            "levels"=>[2,4,6,32,34,49,50],		// show for specific membership level
            "required"=>false,    // make this field required
            "label"=>"Type of Business",
            "memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
        ));


        $fields[] = new PMProRH_Field(
				"Seller_of_Travel",              // input name, will also be used as meta key
				"text",                 // type of field
				array(
					"size"=>40,         // input size
					"profile"=>"only",    // show in user profile
					"required"=>false,    // make this field required
					"levels"=>[4,6,32,34,49,50],		// show for specific membership level
					"label"=>"Seller of travel number (if required in your state)",
					"hint"=>"If not required in your state, please enter NA",
					"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
				));



$fields[] = new PMProRH_Field(
		"Host_Agency",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[1,2,3,4,5,6,9,10,11,12,24,32,34,49,50],		// show for specific membership level
			"label"=>"Who is your Host Agency? (If Applicable):",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"Gross_Annual_Sales",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
            "levels"=>[1,2,3,4,5,6,9,10,11,12,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Estimated Yearly Travel Sales Volume:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


        $fields[] = new PMProRH_Field(
				"Travel_Niche",              // input name, will also be used as meta key
				"text",                 // type of field
				array(
					"size"=>40,         // input size
					"profile"=>"only",    // show in user profile
					"required"=>false,    // make this field required
					"levels"=>[4,6,32,34,49,50],		// show for specific membership level
					"label"=>"Do you specialize in a particular destination of travel niche? If so, list here:",
					"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
				));


$fields[] = new PMProRH_Field(
		"EO_Insurance",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		 "options"=>array(       // <option> elements for select field
				        	    ""=>"",     // <option value=""> </option>
				        "Yes"=>"Yes",     // <option value="Yes">Yes</option>
				        "No"=>"No"),  // <option value="No">No</option>

			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,34,49,50],		// show for specific membership level
			"label"=>"Do you carry E&O General Liability Insurance?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"EO_Insurance_Number",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,34,49,50],		// show for specific membership level
			"label"=>"If yes, what is your policy number?",
			"hint"=>"If you do not carry E&O insurance, please enter NA",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"EO_Insurance_Company",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,34,49,50],		// show for specific membership level
			"label"=>"If yes, what is the name of the insurance company?",
			"hint"=>"If you do not carry E&O insurance, please enter NA",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Director_Contact",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
		        "levels"=>[1,2,3,4,5,6,9,10,11,12,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Were you contacted by a CCRA Director? If so, who?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Industry_code_other?",              // input name, will also be used as meta key

		"select",                 // type of field
		array(
		  "options"=>array(  // <option> elements for select field
				        ""=>"",     // <option value=""> </option>
				        "IATA"=>"IATA",     // <option value="IATA">IATA</option>
				        "IATAN"=>"IATAN",  // <option value="IATAN">IATAN</option>
				        "ARC"=>"ARC",  // <option value="ARC">ARC</option>
				        "ARC VTC"=>"ARC VTC",  // <option value="ARC VTC">ARC VTC</option>
				        "CLIA"=>"CLIA",  // <option value="CLIA">CLIA</option>
				        "Numero de Legajo"=>"Numero de Legajo"),  // <option value="Numero de Legajo">Numero de Legajo</option>
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[1,2,3,4,5,6,9,10,11,12,24,32,33,34,35,49,50],		// show for specific membership level
			"label"=>"Do you use any other industry Code? If yes:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$fields[] = new PMProRH_Field(
		"Accreditation_Held",              // input name, will also be used as meta key

		"select",                 // type of field
		array(
		  "options"=>array(  // <option> elements for select field
				        ""=>"",     // <option value=""> </option>
				        "IATA"=>"IATA",     // <option value="IATA">IATA</option>
				        "ARC"=>"ARC",  // <option value="ARC">ARC</option>
				        "CLIA"=>"CLIA"),  // <option value="CLIA">CLIA</option>

			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Do you Currently Hold Any Accreditation? If yes:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"HowDidYouHear_TGN",              // input name, will also be used as meta key

		"select",                 // type of field
		array(
		  "options"=>array(  // <option> elements for select field
				        ""=>"",     // <option value=""> </option>
				        "Consultation with Team Member"=>"Consultation with Team Member", // <option value="Consultation with Team Member">Consultation with Team Member</option>
				        "Referral"=>"Referral",  // <option value="Referral">Referral</option>
				        "Website"=>"Website",  // <option value="Website">Website</option>
				        "Trade Publication"=>"Trade Publication",  // <option value="Trade Publication">Trade Publication</option>
				        "Industry Tradeshow Event"=>"Industry Tradeshow Event",  // <option value="Industry Tradeshow Event">Industry Tradeshow Event</option>
				        "TRUE Global Network Tradeshow Event"=>"TRUE Global Network Tradeshow Event"),  // <option value="TRUE Global Network Tradeshow Event">TRUE Global Network Tradeshow Event</option>

			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"How Did You Hear of the TRUE Global Network?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));



 if(!pmpro_hasMembershipLevel())
  {
$fields[] = new PMProRH_Field(
		"References",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,34,49,50],		// show for specific membership level
			"label"=>"List the name and contact details for 3 travel industry business references:",
			"memberslistcsv"=>false    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
}

$fields[] = new PMProRH_Field(
		"Other_Travel_Assoc",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		 "options"=>array(  // <option> elements for select field
						        ""=>"",     // <option value=""> </option>
						        "ASTA"=>"ASTA",     // <option value="ASTA">ASTA</option>
						        "NACTA"=>"NACTA",  // <option value="NACTA">NACTA</option>
						        "NEST"=>"NEST",  // <option value="NEST">NEST</option>
						        "ARTA"=>"ARTA"),  // <option value="ARTA">ARTA</option>
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[1,2,3,4,5,6,9,10,11,12,24,32,33,34,35,49,50],		// show for specific membership level
			"label"=>"Are you a member of any other Travel Association or Organization? If yes:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));



$fields[] = new PMProRH_Field(
				"How_did_you_hear",              // input name, will also be used as meta key
				"text",                 // type of field
				array(
				"size"=>40,         // input size
				"profile"=>"only",    // show in user profile
				"required"=>false,    // make this field required
				"levels"=>[1,2,3,4,6,9,10,19,20,32,34,49,50],		// show for specific membership level
				"label"=>"How did you hear about The TRUE Global Network?",
				"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
				));



// new associate agent fields

$fields[] = new PMProRH_Field(
		"AssociateAgt_HostFranchise_YN",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
								        ""=>"",     // <option value=""> </option>
								        "Yes"=>"Yes",     // <option value="Yes">Yes</option>
								        "No"=>"No"),  // <option value="No">No</option>
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"label"=>"Are you with a host agency or do you own a franchise?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_HostFranchise",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
								        ""=>"",     // <option value=""> </option>
								        "Avoya"=>"Avoya",    // <option value="Yes">Yes</option>
										"Cruise Brothers"=>"Cruise Brothers",   // <option value="Yes">Yes</option>
										"CruiseOne"=>"CruiseOne",   // <option value="Yes">Yes</option>
										"Cruiseplanners"=>"Cruiseplanners",    // <option value="Yes">Yes</option>
										"Cruises, Inc."=>"Cruises, Inc.",   // <option value="Yes">Yes</option>
										"Dream Vacations"=>"Dream Vacations",    // <option value="Yes">Yes</option>
										"Dugans Travel"=>"Dugans Travel",    // <option value="Yes">Yes</option>
										"Expedia CruiseShip Center"=>"Expedia CruiseShip Center",   // <option value="Yes">Yes</option>
										"GIFTE"=>"GIFTE",     // <option value="Yes">Yes</option>
										"GroupIt"=>"GroupIt",    // <option value="Yes">Yes</option>
										"InteleTravel"=>"InteleTravel",    // <option value="Yes">Yes</option>
										"KHM"=>"KHM",    // <option value="Yes">Yes</option>
										"M Travel"=>"M Travel",    // <option value="Yes">Yes</option>
										"Nexion"=>"Nexion",    // <option value="Yes">Yes</option>
										"Oasis"=>"Oasis",   // <option value="Yes">Yes</option>
										"Outside Agents"=>"Outside Agents",    // <option value="Yes">Yes</option>
										"ProTravel"=>"ProTravel",   // <option value="Yes">Yes</option>
										"Ticket to Travel"=>"Ticket to Travel",   // <option value="Yes">Yes</option>
										"TPI"=>"TPI",    // <option value="Yes">Yes</option>
										"Travel Edge"=>"Travel Edge",   // <option value="Yes">Yes</option>
										"Travel Network"=>"Travel Network",   // <option value="Yes">Yes</option>
										"Travel Quest"=>"Travel Quest",    // <option value="Yes">Yes</option>
										"Uniglobe"=>"Uniglobe",    // <option value="Yes">Yes</option>
										"Other"=>"Other"),    // <option value="Yes">Yes</option>

			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"label"=>"If you are with a host agency or you own a franchise, which one?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_HostFranchise_Other",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[2],		// show for specific membership level
			"label"=>"If you selected Other in the question above, please explain:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_IndustryAccredType",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
									   ""=>"",
								       "ARC"=>"ARC",
										"VTC"=>"VTC",
										"IATA"=>"IATA",
										"IATAN"=>"IATAN",
								        "CLIA"=>"CLIA",
										"TIDS"=>"TIDS",
								        "Other"=>"Other"),
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"hint"=>"*Industry accreditation is required to become an associate agent member.",
			"label"=>"Which industry accreditation are you using?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_IndustryAccred",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>8,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[2],		// show for specific membership level
			"label"=>"Please enter your industry accreditation number?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_Consortium",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
								        ""=>"",     // <option value=""> </option>
								        "Ensemble"=>"Ensemble",     // <option value="Ensemble">Ensemble</option>
								        "NEST"=>"NEST",  // <option value="NEST">NEST</option>
								        "Signature Travel Network"=>"Signature Travel Network",  // <option value="Signature Travel Network">Signature Travel Network</option>
								        "Travel Leaders"=>"Travel Leaders",  // <option value="Travel Leaders">Travel Leaders</option>
								        "Virtuoso"=>"Virtuoso",  // <option value="Virtuoso">Virtuoso</option>
								        "Other"=>"Other"),  // <option value="Other">Other</option>
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"label"=>"If you are a member of a consortium, please select from the list below:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_ConsortiumOther",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[2],		// show for specific membership level
			"label"=>"If you selected Other in the question above, please explain:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_Niche",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
				""=>"",     // <option value=""> </option>
				"Weddings/Honeymoons"=>"Weddings/Honeymoons",     // <option value="Weddings/Honeymoons">Weddings/Honeymoons</option>
				"Adventure Travel"=>"Adventure Travel",  // <option value="Adventure Travel">Adventure Travel</option>
				"Cruises (river and/or ocean)"=>"Cruises (river and/or ocean)",  // <option value="Cruises (river and/or ocean)">Cruises (river and/or ocean)</option>
				"Cultural Heritage"=>"Cultural Heritage",  // <option value="Cultural Heritage">Cultural Heritage</option>
				"Destination-specific (example: Italy only)"=>"Destination-specific (example: Italy only)",  // <option value="Destination-specific (example: Italy only)">Destination-specific (example: Italy only)</option>
				"Luxury Travel"=>"Luxury Travel",  // <option value="Luxury Travel">Luxury Travel</option>
				"Rail Journeys"=>"Rail Journeys",  // <option value="Rail Journeys">Rail Journeys</option>
				"Road trips"=>"Road trips",  // <option value="Road trips">Road trips</option>
				"Safaris"=>"Safaris",  // <option value="Safaris">Safaris</option>
				"Volunteer"=>"Volunteer",  // <option value="Volunteer">Volunteer</option>
				"Other"=>"Other"),  // <option value="Other">Other</option>
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"label"=>"If you have a travel Niche, please select from the list below:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_NicheOther",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[2],		// show for specific membership level
			"label"=>"If you selected Other in the question above, please explain:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"AssociateAgt_YearsinTravelService",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
								        ""=>"",     // <option value=""> </option>
								        "0 - 4 years"=>"0 - 4 years",     // <option value="0 - 4 years">0 - 4 years</option>
								        "5-9 years"=>"5-9 years",  // <option value="5-9 years">5-9 years</option>
								        "10-15 years"=>"10-15 years",  // <option value="10-15 years">10-15 years</option>
								        "15+ years"=>"15+ years"),  // <option value="15+ years">15+ years</option>

			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"label"=>"How many years have you been a travel agent?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_AnnualSalesVolumeLY",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
								        ""=>"",     // <option value=""> </option>
								        "0 - 10,000"=>"0 - 10,000",     // <option value="0 - 10,000">0 - 10,000</option>
								        "10,001 - 25,000"=>"10,001 - 25,000",  // <option value="10,001 - 25,000">10,001 - 25,000</option>
								        "25,001 - 50,000"=>"25,001 - 50,000",  // <option value="25,001 - 50,000">25,001 - 50,000</option>
								        "50,001 - 75,000"=>"50,001 - 75,000",  // <option value="50,001 - 75,000">50,001 - 75,000</option>
								        "75,001 - 100,000"=>"75,001 - 100,000",  // <option value="75,001 - 100,000">75,001 - 100,000</option>
								        "100,001 - 250,000"=>"100,001 - 250,000",  // <option value="100,001 - 250,000">100,001 - 250,000</option>
								        "250,001 - 500,000"=>"250,001 - 500,000",  // <option value="250,001 - 500,000">250,001 - 500,000</option>
								        "500,001 - 750,000"=>"500,001 - 750,000",  // <option value="500,001 - 750,000">500,001 - 750,000</option>
								        "750,000+"=>"750,000+"),  // <option value="750,000+">750,000+</option>

			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
                        "levels"=>[2],		// show for specific membership level
			"label"=>"Approximate annual sales volume last year:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"AssociateAgt_TRUE_Intent",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		"options"=>array(  // <option> elements for select field
								        ""=>"",     // <option value=""> </option>
								        "Yes"=>"Yes",     // <option value="Yes">Yes</option>
								        "No"=>"No"),  // <option value="No">No</option>
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[2],		// show for specific membership level
			"label"=>"Are you considering getting a TRUE code in the next 6-months?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

// end new associate agent fields


if(!pmpro_hasMembershipLevel())
  {
$fields[] = new PMProRH_Field(
		"TRUE_Code_Purpose",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[4,6,32,34],		// show for specific membership level
			"label"=>"What is your purpose for applying for a TRUE Code?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
}



$fields[] = new PMProRH_Field(
		"Title",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[9,10,31],		// show for specific membership level
			"label"=>"Title:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Chapter",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
		 "options"=>$chapters,  // <option value="Westchester">Westchester</option>
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[2,3,4,6,9,10,11,12,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Chapter",
			"hint"=>"If you do not see a chapter in your area, please select CCRA National Chapter",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"Chapter_Director",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only_admin",    // show in user profile
			"readonly"=>0,    //
			"required"=>false,    // make this field required
			"levels"=>[2,3,4,6,9,10,11,12,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Chapter Director",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"Regional_Director",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only_admin",    // show in user profile
			"readonly"=>0,    //
			"required"=>false,    // make this field required
			"levels"=>[2,3,4,6,9,10,11,12,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Regional Director",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$fields[] = new PMProRH_Field(
		"Notes",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"only_admin",    // show in user profile
			"readonly"=>0,    //
			"required"=>false,    // make this field required
			//"levels"=>[2,3,4,6,7,9,10,11,12,18,19,20,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53],		// show for specific membership level
			"label"=>"Notes",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$fields[] = new PMProRH_Field(
		"TRUE",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>"true",    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[3,4,6,9,10,11,12,24,32,34,35,39,40,43,44,47,48,49,50],		// show for specific membership level
			"label"=>"TRUE",
			"hint"=>"Leave blank if applying for a new accredited or host agency membership",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


//terms and conditions page
	$fields[] = new PMProRH_Field(
		'tos',						// input name, will also be used as meta key
		'checkbox',							// type of field
		array(
			'id'				=> 'tos',		// the HTML element id
			'label'			=> 'Terms & Conditions',	// custom field label
			'size'			=> 40,			// input size
			'required'		=> true,			// make this field required
			'showrequired'		=>	true,		// Show the asterisk(*) next to the field if it is required.
			"levels"=>[4,49],		// show for specific membership level
			'showmainlabel'	=> true,			// Show the <label> for the field.
			'text' => 'Do You Agree to the <a href="https://www.ccra.com/ccra-accreditation-membership-terms-service/" target="_blank">Terms and Conditions?</a>',
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		    ));

//terms and conditions page
	$fields[] = new PMProRH_Field(
		'tos',						// input name, will also be used as meta key
		'checkbox',							// type of field
		array(
			'id'				=> 'tos',		// the HTML element id
			'label'			=> 'Terms & Conditions',	// custom field label
			'size'			=> 40,			// input size
			'required'		=> true,			// make this field required
			'showrequired'		=>	true,		// Show the asterisk(*) next to the field if it is required.
			"levels"=>[6,50],		// show for specific membership level
			'showmainlabel'	=> true,			// Show the <label> for the field.
			'text' => 'Do You Agree to the <a href="https://www.ccra.com/ccra-host-accreditation-membership-terms-service/" target="_blank">Terms and Conditions?</a>',
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		    ));


if(pmpro_hasMembershipLevel() || current_user_can('editor') || current_user_can('administrator'))
  {
$fields[] = new PMProRH_Field(
                "id_card_photo",              // input name, will also be used as meta key
                "file",                 // type of field
                array(
                        "size"=>40,         // input size
                        "profile"=>"true",    // show in user profile
                        "required"=>false,    // make this field required
                        "levels"=>[4,12,6,24,32,33,34,35,39,40,49,50],           // show for specific membership level
                        "label"=>"ID Card Photo",
                        "memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the $
                ));

// the below fields are two opt in fields for marketing
}

 if(!pmpro_hasMembershipLevel())
  {
$fields[] = new PMProRH_Field(
		"OptIn",              // input name, will also be used as meta key
		"html",                 // type of field
		array(
		   "html"=>'<input name="OptIn" type="checkbox" checked="checked" value="true"/>',
			"profile"=>false,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[2,4,11,12,6,24,32,33,34,35,38,39,40,41,42,43,44,45,46,47,48,49,50],		// show for specific membership level
			"label"=>"Get All of the Best Membership Offers Delivered Straight to Your Inbox",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
}

 if(!pmpro_hasMembershipLevel())
  {

$fields[] = new PMProRH_Field(
		"OptIn",              // input name, will also be used as meta key
		"html",                 // type of field
		array(
		   "html"=>'<input name="OptIn" type="checkbox" checked="checked" value="true"/>',
			"profile"=>false,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Get Our Weekly Newsletters Delivered Straight to Your Inbox",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
}


$s_fields[] = new PMProRH_Field(
		"pmpro-logo-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Supplier Logo:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"pmpro-gallery-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Gallery Images:",
			"memberslistcsv"=>true,    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
			"hint"=>"Upload zip file with good quality images for gallery on profile.  You may add captions using text files that have the same name as the image (ie. Hotel.png, Hotel.txt). Upload as many as you like. Ensure to upload only images and text files (no folders) in standard zip file",
));
$s_fields[] = new PMProRH_Field(
		"featured-image-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Featured Post Image:",
			"memberslistcsv"=>true,    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
			"hint"=>"Please upload a featured image which is a representative image for your supplier profile, for best results use image with dimensions of 1200 (width) x 375 (height)"
		));
$s_fields[] = new PMProRH_Field(
		"representative_title",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Representative  Job Title:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"supplier_products",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$supplier_products,
			"multiple"=>true,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"Products:",
			"hint"=>"Please select the travel products your organization provides",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"customer_service_phone",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36,51,52,53],		// show for specific membership level
			"label"=>"Customer Service Phone Number:",
			"hint"=>"Please Provide a Phone number where customers call to get help",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"customer_service_email",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36,51,52,53],		// show for specific membership level
			"label"=>"Customer Service Email Address:",
			"hint"=>"Please Provide an email address  where customers email to get help",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$s_fields[] = new PMProRH_Field(
		"customer_service_contactname",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36,51,52,53],		// show for specific membership level
			"label"=>"Customer Service Contact Name:",
			"hint"=>"Please Provide a contact name for agent assistance",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$s_fields[] = new PMProRH_Field(
		"bh_day_week_start",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>array(
       	    ""=>"",
            "Sunday"=>"Sunday",
            "Monday"=>"Monday",
			"Tuesday"=>"Tuesday",
			"Wednesday"=>"Wednesday",
			"Thursday"=>"Thursday",
			"Friday"=>"Friday",
			"Saturday"=>"Saturday"
			),
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Hours of Operation:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		" ",
		"html",
		array("html"=>"<b style=\"border: none\" class=\"Input \"> Thru </b>",
		"levels"=>[7,19,20,36],
		"profile"=>'only_admin'
));
$s_fields[] = new PMProRH_Field(
		"bh_day_week_end",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>array(
       	    ""=>"",
            "Sunday"=>"Sunday",
            "Monday"=>"Monday",
			"Tuesday"=>"Tuesday",
			"Wednesday"=>"Wednesday",
			"Thursday"=>"Thursday",
			"Friday"=>"Friday",
			"Saturday"=>"Saturday"
			),
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>" ",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		" ",
		"html",
		array("html"=>"<b style=\"border: none\" class=\"Input \"> From </b>",
		"levels"=>[7,19,20,36],
		"profile"=>'only_admin'
));

$s_fields[] = new PMProRH_Field(
		"bh_day_start",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>array(
			""=>"",
			"12:00AM" => "12:00AM", "12:30AM" => "12:30AM",
			"1:00 AM" => "1:00 AM", "1:30 AM" => "1:30 AM",
			"2:00 AM" => "2:00 AM", "2:30 AM" => "2:30 AM",
			"3:00 AM" => "3:00 AM", "3:30 AM" => "3:30 AM",
			"4:00 AM" => "4:00 AM", "4:30 AM" => "4:30 AM",
			"5:00 AM" => "5:00 AM", "5:30 AM" => "5:30 AM",
			"6:00 AM" => "6:00 AM", "6:30 AM" => "6:30 AM",
			"7:00 AM" => "7:00 AM", "7:30 AM" => "7:30 AM",
			"8:00 AM" => "8:00 AM", "8:30 AM" => "8:30 AM",
			"9:00 AM" => "9:00 AM", "9:30 AM" => "9:30 AM",
			"10:00 AM" => "10:00 AM", "10:30 AM" => "10:30 AM",
			"11:00 AM" => "11:00 AM", "11:30 AM" => "11:30 AM",
			"12:00 PM" => "12:00 PM", "12:30 PM" => "12:30 PM",
			"1:00 PM" => "1:00 PM", "1:30 PM" => "1:30 PM",
			"2:00 PM" => "2:00 PM", "2:30 PM" => "2:30 PM",
			"3:00 PM" => "3:00 PM", "3:30 PM" => "3:30 PM",
			"4:00 PM" => "4:00 PM", "4:30 PM" => "4:30 PM",
			"5:00 PM" => "5:00 PM", "5:30 PM" => "5:30 PM",
			"6:00 PM" => "6:00 PM", "6:30 PM" => "6:30 PM",
			"7:00 PM" => "7:00 PM", "7:30 PM" => "7:30 PM",
			"8:00 PM" => "8:00 PM", "8:30 PM" => "8:30 PM",
			"9:00 PM" => "9:00 PM", "9:30 PM" => "9:30 PM",
			"10:00 PM" => "10:00 PM", "10:30 PM" => "10:30 PM",
			"11:00 PM" => "11:00 PM", "11:30 PM" => "11:30 PM"
			),

			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>" ",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		" ",
		"html",
		array("html"=>"<b style=\"border: none\" class=\"Input \"> To </b>",
		"levels"=>[7,19,20,36],
		"profile"=>'only_admin'
));
$s_fields[] = new PMProRH_Field(
		"bh_day_end",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>array(
			""=>"",
			"12:00AM" => "12:00AM", "12:30AM" => "12:30AM",
			"1:00 AM" => "1:00 AM", "1:30 AM" => "1:30 AM",
			"2:00 AM" => "2:00 AM", "2:30 AM" => "2:30 AM",
			"3:00 AM" => "3:00 AM", "3:30 AM" => "3:30 AM",
			"4:00 AM" => "4:00 AM", "4:30 AM" => "4:30 AM",
			"5:00 AM" => "5:00 AM", "5:30 AM" => "5:30 AM",
			"6:00 AM" => "6:00 AM", "6:30 AM" => "6:30 AM",
			"7:00 AM" => "7:00 AM", "7:30 AM" => "7:30 AM",
			"8:00 AM" => "8:00 AM", "8:30 AM" => "8:30 AM",
			"9:00 AM" => "9:00 AM", "9:30 AM" => "9:30 AM",
			"10:00 AM" => "10:00 AM", "10:30 AM" => "10:30 AM",
			"11:00 AM" => "11:00 AM", "11:30 AM" => "11:30 AM",
			"12:00 PM" => "12:00 PM", "12:30 PM" => "12:30 PM",
			"1:00 PM" => "1:00 PM", "1:30 PM" => "1:30 PM",
			"2:00 PM" => "2:00 PM", "2:30 PM" => "2:30 PM",
			"3:00 PM" => "3:00 PM", "3:30 PM" => "3:30 PM",
			"4:00 PM" => "4:00 PM", "4:30 PM" => "4:30 PM",
			"5:00 PM" => "5:00 PM", "5:30 PM" => "5:30 PM",
			"6:00 PM" => "6:00 PM", "6:30 PM" => "6:30 PM",
			"7:00 PM" => "7:00 PM", "7:30 PM" => "7:30 PM",
			"8:00 PM" => "8:00 PM", "8:30 PM" => "8:30 PM",
			"9:00 PM" => "9:00 PM", "9:30 PM" => "9:30 PM",
			"10:00 PM" => "10:00 PM", "10:30 PM" => "10:30 PM",
			"11:00 PM" => "11:00 PM", "11:30 PM" => "11:30 PM"
			),
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>" ",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"supplier_timezone",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$timezones,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Timezone:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"registration_url",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,36,51,52,53],		// show for specific membership level
			"label"=>"Registration Link:",
			"hint"=>"Please Provide a url where your New Customers Sign Up",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"multi_language_support",              // input name, will also be used as meta key
	 "select",                   // type of field
        array(
        	    "options"=>array(       // <option> elements for select field
        	    ""=>"",     // <option value=""> </option>
                	"Yes"=>"Yes",     // <option value="Yes">Yes</option>
		        "No"=>"No"),  // <option value="No">No</option>
			"size"=>40,         // input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Can you work with agents that do not speak English?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"powersolutions_exibitor",              // input name, will also be used as meta key
	 "select",                   // type of field
        array(
        	    "options"=>array(       // <option> elements for select field
        	    ""=>"",     // <option value=""> </option>
                	"Yes"=>"Yes",     // <option value="Yes">Yes</option>
		        "No"=>"No"),  // <option value="No">No</option>
			"size"=>40,         // input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Does Your Company Exhibit at Powersolutions?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));




$s_fields[] = new PMProRH_Field(
		"brochures_available",              // input name, will also be used as meta key
	 "select",                   // type of field
        array(
        	    "options"=>array(       // <option> elements for select field
        	    ""=>"",     // <option value=""> </option>
                	"Yes"=>"Yes",     // <option value="Yes">Yes</option>
		        "No"=>"No"),  // <option value="No">No</option>
			"size"=>40,         // input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,36],		// show for specific membership level
			"label"=>"Does Your Company Have Links to Brochures Available?",
			"hint"=>"If Yes, Please provide links to your hosted brochures below. We cannot host your brochures at this time",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"brochure1",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Brochure Links:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"brochure2",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>" ",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"brochure3",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>" ",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"supplier_category",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$supplier_categories,        // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Supplier Category:",
			"hint"=>'Please select the category that best describes your services',
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"locations",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$countries,
			"multiple"=>true,
			"size"=>15,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Locations Served:",
			"hint"=>'<a onclick="for (var i=0; i < document.getElementById(\'locations\').options.length; i++) {document.getElementById(\'locations\').options[i].selected = true;}document.getElementById(\'facebook\').focus();">Select All</a>&nbsp;&nbsp;&nbsp;<a align="left" onclick="for (var i=0; i < document.getElementById(\'locations\').options.length; i++) {document.getElementById(\'locations\').options[i].selected = false;}document.getElementById(\'facebook\').focus();">Unselect All</a>&nbsp;&nbsp;Use Shift or Ctrl to Select Multiple',
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$s_fields[] = new PMProRH_Field(
		"facebook",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"Facebook:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"twitter",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"Twitter:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"linkedin",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"LinkedIn:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"youtube",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"Youtube:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"pinterest",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"Pinterest:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$s_fields[] = new PMProRH_Field(
		"googleplus",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"Google Plus:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"supplier_excerpt",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>3,
			"columns"=>40,// input size
			"profile"=>only_admin,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Excerpt:",
			"hint"=>"This should be a single sentence that shows up when agents view search results.",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));
$p_fields[] = new PMProRH_Field(
		"supplier_description",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>3,
			"columns"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"Description:",
			"hint"=>"This will detail your organization for agents as part of your supplier profile in 150 words.  If may also be used in other places.",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"supplier_aboutus",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>7,
			"columns"=>40,// input size
			"profile"=>only_admin,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,26,29,36],		// show for specific membership level
			"label"=>"About Us:",
			"hint"=>"This should expand on your offerings with the most complete description of what you can do for our agencies in 500 words.  This will also appear on your Supplier Profile",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

//Airline Supplier News and Policies Uploads 15 files


$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP1-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 1:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP2-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 2:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP3-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 3:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP4-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 4:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP5-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 5:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP6-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 6:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP7-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 7:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP8-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 8:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP9-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 9:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP10-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 10:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP11-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 11:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP12-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 12:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP13-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 13:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP14-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 14:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$p_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerNP15-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner News and Policies 15:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

// End Airline Supplier News and Policies Uploads

$o_fields[] = new PMProRH_Field(
		"offer_cities",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>2,
			"columns"=>40,// input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"What destination cities does your special offer apply to?",
			"hint"=>"Please specify the cities (separated by commas)",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"offer_country",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$countries,
			"multiple"=>true,
			"size"=>15,         // input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,29,36],		// show for specific membership level
			"label"=>"What destination countries do your special offer apply to?",
			"hint"=>'<a onclick="for (var i=0; i < document.getElementById(\'offer_country\').options.length; i++) {document.getElementById(\'offer_country\').options[i].selected = true;}document.getElementById(\'offer_bookby\').focus();">Select All</a>&nbsp;&nbsp;&nbsp;<a align="left" onclick="for (var i=0; i < document.getElementById(\'offer_country\').options.length; i++) {document.getElementById(\'offer_country\').options[i].selected = false;}document.getElementById(\'offer_bookby\').focus();">Unselect All</a>&nbsp;&nbsp;Please Specify the countries. Use Shift or Ctrl to select more than one',
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));



$o_fields[] = new PMProRH_Field(
		"offer_bookby",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$offer_date_open,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Book By Date:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard

		));

$o_fields[] = new PMProRH_Field(
		"offer_details",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>2,
			"columns"=>40,// input size
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Offer Details:",
			"hint"=>"Please be as specific as you can when detailing the offer",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard

));
$o_fields[] = new PMProRH_Field(
		"offer_travel_between_start",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$offer_date_open,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"For Travel Between:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard

		));

$o_fields[] = new PMProRH_Field(
		" ",
		"html",
		array("html"=>"<b style=\"border: none\" class=\"Input \"> To </b>",
		"levels"=>[7,19,20,36],
		"profile"=>'only_admin'
));

$o_fields[] = new PMProRH_Field(
		"offer_travel_between_end",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$offer_date_open,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>" ",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard

		));

$o_fields[] = new PMProRH_Field(
		"offer_booking_url",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"URL to Book Offer:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"offer_booking_email",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,
			"profile"=>'only_admin',    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[7,19,20,36],		// show for specific membership level
			"label"=>"Email for Offer Questions:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"offer_details_AS",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>5,
			"columns"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"What does your Airline offer AirSelect agencies:",
			"hint"=>"Please be as specific as you can when detailing the offer",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
));

//Airline Supplier Offer Uploads 15 files


$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer1-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 1:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer2-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 2:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer3-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 3:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer4-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 4:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer5-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 5:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer6-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 6:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer7-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 7:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer8-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 8:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer9-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 9:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer10-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 10:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer11-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 11:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer12-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 12:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer13-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 13:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer14-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 14:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$o_fields[] = new PMProRH_Field(
		"pmpro-AirPartnerOffer15-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[29],		// show for specific membership level
			"label"=>"AirPartner Offer 15:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

// End Airline Supplier Offer Uploads


//Begin Featured Collection Fields

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Name",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Unique Property Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
));


$bk_fields[] = new PMProRH_Field(
		"BlueKey-Address",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Address:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
));


$bk_fields[] = new PMProRH_Field(
		"BlueKey-City",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"City:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
));


	$bk_fields[] = new PMProRH_Field(
		"BlueKey-State_Province",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$state_province,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"State Province",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

	$bk_fields[] = new PMProRH_Field(
		"BlueKey-Zip_Code",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Zip Code:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$bk_fields[] = new PMProRH_Field(
		"BlueKey-Country",              // input name, will also be used as meta key
		"select",                 // type of field
		array(
			"options"=>$countries,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Country",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


	$bk_fields[] = new PMProRH_Field(
		"BlueKey-Business_Phone",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Phone Number:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$bk_fields[] = new PMProRH_Field(
		"BlueKey-logo-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Featured Collection Logo (200x288 px):",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-image1-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Featured Collection Image 1:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-image2-upload",              // input name, will also be used as meta key
		"file",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Featured Collection Image 2:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Website_URL",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Website URL:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$bk_fields[] = new PMProRH_Field(
		"BlueKey-Contact_FirstName",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Contact First Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Contact_LastName",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Contact Last Name:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Contact_Title",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Contact Title:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Contact_EmailAddress",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Contact Email Address:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Contact_PhoneNumber",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>true,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Contact Phone Number:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


$bk_fields[] = new PMProRH_Field(
		"BlueKey-Facebook_URL",              // input name, will also be used as meta key
		"text",                 // type of field
		array(
			"size"=>40,         // input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Property Facebook Link:",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

		$bk_fields[] = new PMProRH_Field(
				"BlueKey-Property_Instagram_URL",              // input name, will also be used as meta key
				"text",                 // type of field
				array(
					"size"=>40,         // input size
					"profile"=>true,    // show in user profile
					"required"=>false,    // make this field required
					"levels"=>[30],		// show for specific membership level
					"label"=>"Property Instagram Link:",
					"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

		$bk_fields[] = new PMProRH_Field(
				"BlueKey-Property_YouTube_URL",              // input name, will also be used as meta key
				"text",                 // type of field
				array(
					"size"=>40,         // input size
					"profile"=>true,    // show in user profile
					"required"=>false,    // make this field required
					"levels"=>[30],		// show for specific membership level
					"label"=>"Property YouTube Link:",
					"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Description",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>5,
			"columns"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"Featured Collection Description: (Limit 300 chars):",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));

$bk_fields[] = new PMProRH_Field(
		"BlueKey-Unique_Description",              // input name, will also be used as meta key
		"textarea",                 // type of field
		array(
			"rows"=>5,
			"columns"=>40,// input size
			"profile"=>true,    // show in user profile
			"required"=>false,    // make this field required
			"levels"=>[30],		// show for specific membership level
			"label"=>"What is unique about this property?",
			"memberslistcsv"=>true    // Show this field on the CSV export when using the Export to CSV feature on the Members List page in the WordPress dashboard
		));


//End Blue Key Collection Fields


	pmprorh_add_checkout_box("checkout_boxes", "<br />More Information<br /><br />");
	pmprorh_add_checkout_box("supplier_directory", "<br />Directory Information<br /><br />");
	pmprorh_add_checkout_box("supplier_offer", "<br />Offer Listing<br /><br />");
	pmprorh_add_checkout_box("supplier_profile", "<br />Profile Descriptions<br /><br />");
	pmprorh_add_checkout_box("Featured_supplier_profile", "<br />Featured Collection Profile<br /><br />");


    //add the fields into a new checkout_boxes are of the checkout page
    foreach($fields as $field)
        pmprorh_add_registration_field(
            "checkout_boxes", // location on checkout page
            $field            // PMProRH_Field object
        );

	foreach($s_fields as $field)
	pmprorh_add_registration_field(
            "supplier_directory", // location on checkout page
            $field            // PMProRH_Field object
	);

	foreach($o_fields as $field)
	pmprorh_add_registration_field(
            "supplier_offer", // location on checkout page
            $field            // PMProRH_Field object
	);

	foreach($p_fields as $field)
	pmprorh_add_registration_field(
            "supplier_profile", // location on checkout page
            $field            // PMProRH_Field object
	);

	foreach($bk_fields as $field)
	pmprorh_add_registration_field(
	         "Featured_supplier_profile", // location on checkout page
	         $field            // PMProRH_Field object
	);



    //that's it. see the PMPro Register Helper readme for more information and examples.
}

add_action("init", "generate_ccra_globals");
add_action("init", "my_pmprorh_init");



/*
	Disable the "Expired" emails in Paid Memberships Pro
*/
function my_pmpro_email_recipient($recipient, $email)
{
	if($email->template == "membership_expired" || $email->template == "membership_expiring") //could check for a different template here
		$recipient = NULL;
	return $recipient;
}
add_filter("pmpro_email_recipient", "my_pmpro_email_recipient", 10, 2);


/*
  Only let level 1 members sign up if they use a discount code.
  Place this code in your active theme's functions.php or a custom plugin.
*/
function my_pmpro_registration_checks_require_code_to_register($pmpro_continue_registration)
{
  //only bother if things are okay so far
	if(!$pmpro_continue_registration)
		return $pmpro_continue_registration;

	//level = 11 and there is no discount code, then show an error message
	global $pmpro_level, $discount_code;

  //if(($pmpro_level->id == 24 || $pmpro_level->id == 12 || $pmpro_level->id == 33 || $pmpro_level->id == 35 ) && (empty($discount_code) || $discount_code != "REQUIRED_CODE")) //use this conditional to check for a specific code.
  if(($pmpro_level->id == 24 || $pmpro_level->id == 12 || $pmpro_level->id == 33 || $pmpro_level->id == 35) && empty($discount_code))
	{
		pmpro_setMessage("You must use a valid Sub-Agent invitation code to register for this level.", "pmpro_error");
		return false;
	}

	return $pmpro_continue_registration;
}
add_filter("pmpro_registration_checks", "my_pmpro_registration_checks_require_code_to_register");


function my_update_first_and_last_name_after_checkout($user_id)
{

 if(isset($_REQUEST['Agent_First_Name']))
 {
  $firstname = $_REQUEST['Agent_First_Name'];
  $lastname = $_REQUEST['Agent_Last_Name'];
 }
 elseif(isset($_REQUEST['Representative_First_Name']))
 {
  $firstname = $_REQUEST['Representative_First_Name'];
  $lastname = $_REQUEST['Representative_Last_Name'];
 }
 elseif(isset($_SESSION['firstname']))
 {
  //maybe in sessions?
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];

  //unset
  unset($_SESSION['firstname']);
  unset($_SESSION['lastname']);
 }

 if(isset($firstname))
  update_user_meta($user_id, "first_name", $firstname);
 if(isset($lastname))
  update_user_meta($user_id, "last_name", $lastname);


 if(isset($_REQUEST['Chapter']))
 {
  $lk_Chapter_arr = gen_director_assoc();
  $Chapter_Director = $lk_Chapter_arr[$_REQUEST['Chapter']]['Chapter_Director'];
  $Regional_Director = $lk_Chapter_arr[$_REQUEST['Chapter']]['Regional_Director'];
  update_user_meta($user_id, "Chapter_Director", $Chapter_Director);
  update_user_meta($user_id, "Regional_Director", $Regional_Director);
 }





}


add_action('pmpro_after_checkout', 'my_update_first_and_last_name_after_checkout');
add_action('profile_update','my_update_first_and_last_name_after_checkout', 100, 2);

function get_tablepress_post_id($table_id) {
$tables = json_decode(get_option('tablepress_tables'),true);
return $tables['table_post'][$table_id];
}


function gen_chapter_options () {
global $wpdb;

$q1 = "select post_content from wp_posts where id = ". get_tablepress_post_id(5);
$row = $wpdb->get_results($q1,ARRAY_A);
$table_data = json_decode($row[0]['post_content'],true);

foreach ($table_data[0] as $col => $header_field) {
        if ($header_field == "Chapter") {
        $col_Chapter = $col;
        }
        if ($header_field == "Chapter Director") {
        $col_Chapter_Director = $col;
        }
        if ($header_field == "Regional Director") {
        $col_Regional_Director = $col;
        }
}

foreach ($table_data as $key=>$it_Chapter) {
  if ($key != 0) {
    $options_arr[$it_Chapter[$col_Chapter]] = $it_Chapter[$col_Chapter];
  }
}
return $options_arr;
}

function gen_director_assoc () {
global $wpdb;


$q1 = "select post_content from wp_posts where id = ". get_tablepress_post_id(5);
$row = $wpdb->get_results($q1,ARRAY_A);
$table_data = json_decode($row[0]['post_content'],true);

foreach ($table_data[0] as $col => $header_field) {
        if ($header_field == "Chapter") {
        $col_Chapter = $col;
        }
        if ($header_field == "Chapter_Director") {
        $col_Chapter_Director = $col;
        }
        if ($header_field == "Regional_Director") {
        $col_Regional_Director = $col;
        }
}

foreach ($table_data as $key=>$it_Chapter) {
  if ($key != 0) {
    $options_arr[$it_Chapter[$col_Chapter]] = $it_Chapter[$col_Chapter];
    $director_arr[$it_Chapter[$col_Chapter]] = array("Chapter_Director"=>$it_Chapter[$col_Chapter_Director],"Regional_Director"=>$it_Chapter[$col_Regional_Director]);
  }
}
return $director_arr;
}




/*
  Show Members Reports on the WordPress Admin Dashboard.
  Update the my_pmpro_dashboard_report() function to remove or add core or custom reports.
*/
//Create a Dashboard Reports widget for Paid Memberships Pro
function add_my_report_dashboard() {
	if( ! defined( 'PMPRO_DIR' )  || ! current_user_can( 'manage_options' ) )
	{
		return;
	}
	wp_add_dashboard_widget(
		'pmpro_membership_dashboard',
		__( 'Paid Membership Pro Reports' , 'pmpro' ),
		'my_pmpro_dashboard_report'
	);
}
add_action( 'wp_dashboard_setup', 'add_my_report_dashboard' );
//Callback function for the widget
function my_pmpro_dashboard_report() {
	//included report pages
	require_once( PMPRO_DIR . '/adminpages/reports/login.php' );
	require_once( PMPRO_DIR . '/adminpages/reports/memberships.php' );
	require_once( PMPRO_DIR . '/adminpages/reports/sales.php' );
	//show Visits/Views/Logins report
	echo '<h3>' . __( 'Visit, Views and Logins', 'pmpro' ) . '</h3>';
	pmpro_report_login_widget();
	//show Membership report
	echo '<br /><h3>' . __( 'Membership Stats', 'pmpro' ) . '</h3>';
	pmpro_report_memberships_widget();
	//show Sales and Revenue report
	echo '<br /><h3>' . __( 'Sales and Revenue', 'pmpro' ) . '</h3>';
	pmpro_report_sales_widget();
	//show link to all PMPro reports
	echo '<p style="text-align: center;"><a class="button-primary" href="' . admin_url( 'admin.php?page=pmpro-reports' ) . '">' . __( 'View All Reports', 'pmpro' ) . '</a></p>';
}


/*===============================================================================================================================*/

/*
 * Requires PMPro >= v2.3
 *
 * Filters for adding columns:
 * - 'manage_{$screen->id}_columns'
 *   - Default filter in WP_List_Table class to modify columns
 * - 'pmpro_manage_memberslist_columns'
 *   - Modifies columns in default locaiton of PMPro Members List
 *   - Equivalent to 'manage_memberships_page_pmpro-memberslist_columns'
 *
 * Hook for filling column data:
 * - 'pmpro_manage_memberslist_custom_column'
 */

// Copy from below here...

/**
 * Adds "TRUE" column to Members List.
 *
 * @param  array $columns for table.
 * @return array
 */

function my_pmpro_add_memberslist_col_TRUE( $columns ) {
	$columns['TRUE'] = 'TRUE';
	return $columns;
}
add_filter( 'pmpro_manage_memberslist_columns', 'my_pmpro_add_memberslist_col_TRUE' );

/**
 * Fills the "TRUE" column of the Members List.
 *
 * @param  string $colname column being filled.
 * @param  string $user_id to get information for.
 */

function my_pmpro_fill_memberslist_col_TRUE( $colname, $user_id ) {
	if ( 'TRUE' === $colname ) {
		echo esc_html( get_user_meta( $user_id, 'TRUE', true ) );
	}
}
add_filter( 'pmpro_manage_memberslist_custom_column', 'my_pmpro_fill_memberslist_col_TRUE', 10, 2 );



/*===============================================================================================================================*/

// Additional Agent sponsored account levels

global $pmprosm_sponsored_account_levels;

$pmprosm_sponsored_account_levels = array(
		//set seats at checkout
		6 => array(
			'main_level_id' => 6,		//redundant but useful
			'sponsored_level_id' => 24,	//array or single id
			'discount_code_required' => true,
			'add_code_to_confirmation_email' => false,
			'sponsored_accounts_at_checkout' => false,
			'seats' => 24
		),
		50 => array(
					'main_level_id' => 50,		//redundant but useful
					'sponsored_level_id' => 24,	//array or single id
					'discount_code_required' => true,
					'add_code_to_confirmation_email' => false,
					'sponsored_accounts_at_checkout' => false,
					'seats' => 24
		),
		4 => array(
					'main_level_id' => 4,		//redundant but useful
					'sponsored_level_id' => 12,	//array or single id
					'discount_code_required' => true,
					'add_code_to_confirmation_email' => True,
					'sponsored_accounts_at_checkout' => false,
					'seats' => 4
		),
		49 => array(
							'main_level_id' => 49,		//redundant but useful
							'sponsored_level_id' => 12,	//array or single id
							'discount_code_required' => true,
							'add_code_to_confirmation_email' => True,
							'sponsored_accounts_at_checkout' => false,
							'seats' => 4
		),
		32 => array(
					'main_level_id' => 32,		//redundant but useful
					'sponsored_level_id' => array(35,12),	//array or single id
					'discount_code_required' => true,
					'add_code_to_confirmation_email' => True,
					'sponsored_accounts_at_checkout' => false,
					'seats' => 4,
				   'initial_payment' => array(35 => 25)

		),
		34 => array(
							'main_level_id' => 34,		//redundant but useful
							'sponsored_level_id' => array(35,24),	//array or single id
							'discount_code_required' => true,
							'add_code_to_confirmation_email' => True,
							'sponsored_accounts_at_checkout' => false,
							'seats' => 24,
							'initial_payment' => array(35 => 25)

		),
		39 => array(
					'main_level_id' => 39,		//redundant but useful
					'sponsored_level_id' => array(35,12),	//array or single id
					'discount_code_required' => true,
					'add_code_to_confirmation_email' => True,
					'sponsored_accounts_at_checkout' => false,
					'seats' => 4,
					'initial_payment' => array(35 => 25)

		),
		40 => array(
							'main_level_id' => 40,		//redundant but useful
							'sponsored_level_id' => array(35,24),	//array or single id
							'discount_code_required' => true,
							'add_code_to_confirmation_email' => True,
							'sponsored_accounts_at_checkout' => false,
							'seats' => 24,
							 'initial_payment' => array(35 => 25)

		),
		45 => array(
					'main_level_id' => 45,		//redundant but useful
					'sponsored_level_id' => 33,	//array or single id
					'discount_code_required' => true,
					'add_code_to_confirmation_email' => true,
					'sponsored_accounts_at_checkout' => false,
					'initial_payment' => array(33 => 25)
		),
		46 => array(
					'main_level_id' => 46,		//redundant but useful
					'sponsored_level_id' => 33,	//array or single id
					'discount_code_required' => true,
					'add_code_to_confirmation_email' => true,
					'sponsored_accounts_at_checkout' => false,
					'seats' => 100,
				     'initial_payment' => array(33 => 25)

		),
		47 => array(
							'main_level_id' => 47,		//redundant but useful
							'sponsored_level_id' => 35,	//array or single id
							'discount_code_required' => true,
							'add_code_to_confirmation_email' => true,
							'sponsored_accounts_at_checkout' => false,
							'seats' => 100,
							'initial_payment' => array(35 => 25)

		),
		48 => array(
							'main_level_id' => 48,		//redundant but useful
							'sponsored_level_id' => 35,	//array or single id
							'discount_code_required' => true,
							'add_code_to_confirmation_email' => true,
							'sponsored_accounts_at_checkout' => false,
					'seats' => 100,
					'initial_payment' => array(35 => 25)
		)
	);


function generate_ccra_globals () {
global $countries;

$countries = Array
(' '=>'',
'US'=>'United States',
'AF'=>'Afghanistan',
'AL'=>'Albania',
'DZ'=>'Algeria',
'AS'=>'American Samoa',
'AD'=>'Andorra',
'AO'=>'Angola',
'AI'=>'Anguilla',
'AQ'=>'Antarctica',
'AG'=>'Antigua and Barbuda',
'AR'=>'Argentina',
'AM'=>'Armenia',
'AW'=>'Aruba',
'AU'=>'Australia',
'AT'=>'Austria',
'AZ'=>'Azerbaijan',
'BS'=>'Bahamas',
'BH'=>'Bahrain',
'BD'=>'Bangladesh',
'BB'=>'Barbados',
'BY'=>'Belarus',
'BE'=>'Belgium',
'BZ'=>'Belize',
'BJ'=>'Benin',
'BM'=>'Bermuda',
'BT'=>'Bhutan',
'BO'=>'Bolivia',
'BA'=>'Bosnia and Herzegovina',
'BW'=>'Botswana',
'BV'=>'Bouvet Island',
'BR'=>'Brazil',
'BQ'=>'British Antarctic Territory',
'IO'=>'British Indian Ocean Territory',
'VG'=>'British Virgin Islands',
'BN'=>'Brunei',
'BG'=>'Bulgaria',
'BF'=>'Burkina Faso',
'BI'=>'Burundi',
'KH'=>'Cambodia',
'CM'=>'Cameroon',
'CA'=>'Canada',
'CT'=>'Canton and Enderbury Islands',
'CV'=>'Cape Verde',
'KY'=>'Cayman Islands',
'CF'=>'Central African Republic',
'TD'=>'Chad',
'CL'=>'Chile',
'CN'=>'China',
'CX'=>'Christmas Island',
'CC'=>'Cocos [Keeling] Islands',
'CO'=>'Colombia',
'KM'=>'Comoros',
'CG'=>'Congo - Brazzaville',
'CD'=>'Congo - Kinshasa',
'CK'=>'Cook Islands',
'CR'=>'Costa Rica',
'HR'=>'Croatia',
'CU'=>'Cuba',
'CY'=>'Cyprus',
'CZ'=>'Czech Republic',
'CI'=>'Côte d’Ivoire',
'DK'=>'Denmark',
'DJ'=>'Djibouti',
'DM'=>'Dominica',
'DO'=>'Dominican Republic',
'NQ'=>'Dronning Maud Land',
'DD'=>'East Germany',
'EC'=>'Ecuador',
'EG'=>'Egypt',
'SV'=>'El Salvador',
'GQ'=>'Equatorial Guinea',
'ER'=>'Eritrea',
'EE'=>'Estonia',
'ET'=>'Ethiopia',
'FK'=>'Falkland Islands',
'FO'=>'Faroe Islands',
'FJ'=>'Fiji',
'FI'=>'Finland',
'FR'=>'France',
'GF'=>'French Guiana',
'PF'=>'French Polynesia',
'TF'=>'French Southern Territories',
'FQ'=>'French Southern and Antarctic Territories',
'GA'=>'Gabon',
'GM'=>'Gambia',
'GE'=>'Georgia',
'DE'=>'Germany',
'GH'=>'Ghana',
'GI'=>'Gibraltar',
'GR'=>'Greece',
'GL'=>'Greenland',
'GD'=>'Grenada',
'GP'=>'Guadeloupe',
'GU'=>'Guam',
'GT'=>'Guatemala',
'GG'=>'Guernsey',
'GN'=>'Guinea',
'GW'=>'Guinea-Bissau',
'GY'=>'Guyana',
'HT'=>'Haiti',
'HM'=>'Heard Island and McDonald Islands',
'HN'=>'Honduras',
'HK'=>'Hong Kong SAR China',
'HU'=>'Hungary',
'IS'=>'Iceland',
'IN'=>'India',
'ID'=>'Indonesia',
'IR'=>'Iran',
'IQ'=>'Iraq',
'IE'=>'Ireland',
'IM'=>'Isle of Man',
'IL'=>'Israel',
'IT'=>'Italy',
'JM'=>'Jamaica',
'JP'=>'Japan',
'JE'=>'Jersey',
'JT'=>'Johnston Island',
'JO'=>'Jordan',
'KZ'=>'Kazakhstan',
'KE'=>'Kenya',
'KI'=>'Kiribati',
'KW'=>'Kuwait',
'KG'=>'Kyrgyzstan',
'LA'=>'Laos',
'LV'=>'Latvia',
'LB'=>'Lebanon',
'LS'=>'Lesotho',
'LR'=>'Liberia',
'LY'=>'Libya',
'LI'=>'Liechtenstein',
'LT'=>'Lithuania',
'LU'=>'Luxembourg',
'MO'=>'Macau SAR China',
'MK'=>'Macedonia',
'MG'=>'Madagascar',
'MW'=>'Malawi',
'MY'=>'Malaysia',
'MV'=>'Maldives',
'ML'=>'Mali',
'MT'=>'Malta',
'MH'=>'Marshall Islands',
'MQ'=>'Martinique',
'MR'=>'Mauritania',
'MU'=>'Mauritius',
'YT'=>'Mayotte',
'FX'=>'Metropolitan France',
'MX'=>'Mexico',
'FM'=>'Micronesia',
'MI'=>'Midway Islands',
'MD'=>'Moldova',
'MC'=>'Monaco',
'MN'=>'Mongolia',
'ME'=>'Montenegro',
'MS'=>'Montserrat',
'MA'=>'Morocco',
'MZ'=>'Mozambique',
'MM'=>'Myanmar [Burma]',
'NA'=>'Namibia',
'NR'=>'Nauru',
'NP'=>'Nepal',
'NL'=>'Netherlands',
'AN'=>'Netherlands Antilles',
'NT'=>'Neutral Zone',
'NC'=>'New Caledonia',
'NZ'=>'New Zealand',
'NI'=>'Nicaragua',
'NE'=>'Niger',
'NG'=>'Nigeria',
'NU'=>'Niue',
'NF'=>'Norfolk Island',
'KP'=>'North Korea',
'VD'=>'North Vietnam',
'MP'=>'Northern Mariana Islands',
'NO'=>'Norway',
'OM'=>'Oman',
'PC'=>'Pacific Islands Trust Territory',
'PK'=>'Pakistan',
'PW'=>'Palau',
'PS'=>'Palestinian Territories',
'PA'=>'Panama',
'PZ'=>'Panama Canal Zone',
'PG'=>'Papua New Guinea',
'PY'=>'Paraguay',
'YD'=>'People\'s Democratic Republic of Yemen',
'PE'=>'Peru',
'PH'=>'Philippines',
'PN'=>'Pitcairn Islands',
'PL'=>'Poland',
'PT'=>'Portugal',
'PR'=>'Puerto Rico',
'QA'=>'Qatar',
'RO'=>'Romania',
'RU'=>'Russia',
'RW'=>'Rwanda',
'RE'=>'Réunion',
'BL'=>'Saint Barthélemy',
'SH'=>'Saint Helena',
'KN'=>'Saint Kitts and Nevis',
'LC'=>'Saint Lucia',
'MF'=>'Saint Martin',
'PM'=>'Saint Pierre and Miquelon',
'VC'=>'Saint Vincent and the Grenadines',
'WS'=>'Samoa',
'SM'=>'San Marino',
'SA'=>'Saudi Arabia',
'SN'=>'Senegal',
'RS'=>'Serbia',
'CS'=>'Serbia and Montenegro',
'SC'=>'Seychelles',
'SL'=>'Sierra Leone',
'SG'=>'Singapore',
'SK'=>'Slovakia',
'SI'=>'Slovenia',
'SB'=>'Solomon Islands',
'SO'=>'Somalia',
'ZA'=>'South Africa',
'GS'=>'South Georgia and the South Sandwich Islands',
'KR'=>'South Korea',
'ES'=>'Spain',
'LK'=>'Sri Lanka',
'SD'=>'Sudan',
'SR'=>'Suriname',
'SJ'=>'Svalbard and Jan Mayen',
'SZ'=>'Swaziland',
'SE'=>'Sweden',
'CH'=>'Switzerland',
'SY'=>'Syria',
'ST'=>'São Tomé and Príncipe',
'TW'=>'Taiwan',
'TJ'=>'Tajikistan',
'TZ'=>'Tanzania',
'TH'=>'Thailand',
'TL'=>'Timor-Leste',
'TG'=>'Togo',
'TK'=>'Tokelau',
'TO'=>'Tonga',
'TT'=>'Trinidad and Tobago',
'TN'=>'Tunisia',
'TR'=>'Turkey',
'TM'=>'Turkmenistan',
'TC'=>'Turks and Caicos Islands',
'TV'=>'Tuvalu',
'UM'=>'U.S. Minor Outlying Islands',
'PU'=>'U.S. Miscellaneous Pacific Islands',
'VI'=>'U.S. Virgin Islands',
'UG'=>'Uganda',
'UA'=>'Ukraine',
'SU'=>'Union of Soviet Socialist Republics',
'AE'=>'United Arab Emirates',
'GB'=>'United Kingdom',
'ZZ'=>'Unknown or Invalid Region',
'UY'=>'Uruguay',
'UZ'=>'Uzbekistan',
'VU'=>'Vanuatu',
'VA'=>'Vatican City',
'VE'=>'Venezuela',
'VN'=>'Vietnam',
'WK'=>'Wake Island',
'WF'=>'Wallis and Futuna',
'EH'=>'Western Sahara',
'YE'=>'Yemen',
'ZM'=>'Zambia',
'ZW'=>'Zimbabwe',
'AX'=>'Åland Islands');

global $state_province;
$state_province = Array(
'  '=>' ',
'--US--'=>'---United States---',
'AL'=>'Alabama',
'AK'=>'Alaska',
'AZ'=>'Arizona',
'AR'=>'Arkansas',
'CA'=>'California',
'CO'=>'Colorado',
'CT'=>'Connecticut',
'DC'=>'District of Columbia',
'DE'=>'Delaware',
'FL'=>'Florida',
'GA'=>'Georgia',
'HI'=>'Hawaii',
'ID'=>'Idaho',
'IL'=>'Illinois',
'IN'=>'Indiana',
'IA'=>'Iowa',
'KS'=>'Kansas',
'KY'=>'Kentucky',
'LA'=>'Louisiana',
'ME'=>'Maine',
'MD'=>'Maryland',
'MA'=>'Massachusetts',
'MI'=>'Michigan',
'MN'=>'Minnesota',
'MS'=>'Mississippi',
'MO'=>'Missouri',
'MT'=>'Montana',
'NE'=>'Nebraska',
'NV'=>'Nevada',
'NH'=>'New Hampshire',
'NJ'=>'New Jersey',
'NM'=>'New Mexico',
'NY'=>'New York',
'NC'=>'North Carolina',
'ND'=>'North Dakota',
'OH'=>'Ohio',
'OK'=>'Oklahoma',
'OR'=>'Oregon',
'PA'=>'Pennsylvania',
'RI'=>'Rhode Island',
'SC'=>'South Carolina',
'SD'=>'South Dakota',
'TN'=>'Tennessee',
'TX'=>'Texas',
'UT'=>'Utah',
'VT'=>'Vermont',
'VA'=>'Virginia',
'WA'=>'Washington',
'WV'=>'West Virginia',
'WI'=>'Wisconsin',
'WY'=>'Wyoming',
'--UST--'=>'---US Territories---',
'AS'=>'American Samoa',
'FM'=>'Federated States of Micronesia',
'GU'=>'Guam',
'MH'=>'Marshall Islands',
'MP'=>'Northern Mariana Islands',
'PR'=>'Puerto Rico',
'PW'=>'Palau',
'VI'=>'Virgin Islands',
'--CA--'=>'---Canada---',
'AB'=>'Alberta',
'BC'=>'British Columbia',
'MB'=>'Manitoba',
'NB'=>'New Brunswick',
'NL'=>'Newfoundland and Labrador',
'NS'=>'Nova Scotia',
'ON'=>'Ontario',
'PE'=>'Prince Edward Island',
'QC'=>'Quebec',
'SK'=>'Saskatchewan',
'NT'=>'Northwest Territories',
'YK'=>'Yukon Territory',
'--MX--'=>'---Mexico---',
'MX-AG'=>'Aguascalientes',
'MX-BC'=>'Baja California',
'MX-BS'=>'Baja California Sur',
'MX-CM'=>'Campeche',
'MX-CS'=>'Chiapas',
'MX-CH'=>'Chihuahua',
'MX-CO'=>'Coahuila',
'MX-CL'=>'Colima',
'MX-DF'=>'Distrito Federal',
'MX-DG'=>'Durango',
'MX-GT'=>'Guanajuato',
'MX-GR'=>'Guerrero',
'MX-EM'=>'Edo. Mexico',
'MX-HG'=>'Hidalgo',
'MX-JA'=>'Jalisco',
'MX-MI'=>'Michoacan',
'MX-MO'=>'Morelos',
'MX-NA'=>'Nayarit',
'MX-NL'=>'Nuevo Leon',
'MX-OA'=>'Oaxaca',
'MX-PU'=>'Puebla',
'MX-QT'=>'Queretaro',
'MX-QR'=>'Quintana Roo',
'MX-SL'=>'San Luis Potosi',
'MX-SI'=>'Sinaloa',
'MX-SO'=>'Sonora',
'MX-TB'=>'Tabasco',
'MX-TM'=>'Tamaulipas',
'MX-TL'=>'Tlaxcala',
'MX-VE'=>'Veracruz',
'MX-YU'=>'Yucatan',
'MX-ZA'=>'Zacatecas',
'--AU--'=>'---Australia---',
'ACT'=>'Australian Capital Territory',
'NSW'=>'New South Wales',
'NT'=>'Northern Territory',
'QLW'=>'Queensland',
'SA'=>'South Australia',
'TAS'=>'Tasmania',
'VIC'=>'Victoria',
'AU-WA'=>'Western Australia',
'--BR--'=>'---Brazil---',
'BR-AC'=>'Acre',
'BR-AL'=>'Alagoas',
'BR-AM'=>'Amazonas',
'BR-AP'=>'Amapa',
'BR-BA'=>'Bahia',
'BR-CE'=>'Ceara',
'BR-DF'=>'Distrito Federal',
'BR-ES'=>'Espirito Santo',
'BR-GO'=>'Goias',
'BR-MA'=>'Maranhao',
'BR-MG'=>'Minas Gerais',
'BR-MT'=>'Mato Grosso',
'BR-MS'=>'Mato Grosso do Sul',
'BR-PA'=>'Para',
'BR-PB'=>'Paraiba',
'BR-PR'=>'Parana',
'BR-PE'=>'Pernambuco',
'BR-PI'=>'Piaui',
'BR-RJ'=>'Rio de Janeiro',
'BR-RN'=>'Rio Grande do Norte',
'BR-RS'=>'Rio Grande do Sul',
'BR-RO'=>'Rondonia',
'BR-RR'=>'Roraima',
'BR-SC'=>'Santa Catarina',
'BR-SE'=>'Sergipe',
'BR-SP'=>'Sao Paulo',
'BR-TO'=>'Tocantins');


global $wpdb;
global $supplier_categories;
$supplier_categories = array();
$categories = $wpdb->get_results('Select * from '. $wpdb->prefix.'supplier_category order by category ASC');
foreach ($categories as $category){
$supplier_categories["$category->id"]  = $category->category;
}

global $offer_dates;
$begin = new DateTime();
$end = new DateTime();

$end = $end->modify( '+2 year' );
$interval = new DateInterval('P1D');

$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
$offer_dates[$date->format("m-d-Y")] = $date->format("m-d-Y");
}

global $supplier_products;

$supplier_products = Array
('Group Tours' => 'Group Tours',
'FIT Tours' => 'FIT Tours',
'Private Car Service' => 'Private Car Service',
'Ground Transportation' => 'Ground Transportation',
'Air Carrier' => 'Air Carrier',
'Air Consolidator' => 'Air Consolidator',
'Theme/Amusement Parks' => 'Theme/Amusement Parks',
'Marketing Technology' => 'Marketing Technology',
'CRM / Back Office Products' => 'CRM / Back Office Products',
'Host Agency' => 'Host Agency',
'Boutique Hotel Accommodations' => 'Boutique Hotel Accommodations',
'Hotel' => 'Hotel',
'Bed and Breakfast' => 'Bed and Breakfast ',
'Bus Transportation' => 'Bus Transportation',
'Event Tickets' => 'Event Tickets',
'Luxury Tours' => 'Luxury Tours',
'Legal Services' => 'Legal Services',
'Accounting Services' => 'Accounting Services',
'Business Licensing Services' => 'Business Licensing Services',
'Seller of Travel Licensing' => 'Seller of Travel Licensing',
'Bond Agencies' => 'Bond Agencies',
'Consortiums' => 'Consortiums',
'Historical Tours' => 'Historical Tours',
'Genealogy Tours' => 'Genealogy Tours',
'Voluntourism' => 'Voluntourism',
'Religious / Missionary Travel' => 'Religious / Missionary Travel',
'Medical Tourism' => 'Medical Tourism',
'Travel Agency Marketing Services' => 'Travel Agency Marketing Services',
'Agent Booking Engine' => 'Agent Booking Engine',
'Commissionable Products' => 'Commissionable Products',
'Ocean Cruises' => 'Ocean Cruises',
'River Cruises' => 'River Cruises',
'Travel Insurance' => 'Travel Insurance',
'Tailor Made' => 'Tailor Made',
'All Inclusive Resorts' => 'All Inclusive Resorts',
'Adults Only Resorts' => 'Adults Only Resorts',
'Adults Only Cruising' => 'Adults Only Cruising');

ksort($supplier_products);

}

function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

     //   $timezone_list[$pretty_offset] = "(${pretty_offset}) $timezone";
	 $timezone_list[$pretty_offset] = "(${pretty_offset})";
    }

	$US_timezones = Array(' '=> ' ','EST' => 'EST', 'CST' => 'CST', 'MST' => 'MST', 'PST' => 'PST');

	$timezones = $US_timezones + $timezone_list;

    return $timezones;

}


/*
	Early Renewal Discount
*/
function erd_pmpro_checkout_level($level)
{
	//if a discount code is being used, ignore the renewal price
	global $discount_code;


	//PMPro fix/edit 5/20/2019 by Hersha Venkatesh
	if(!empty($discount_code) || (isset($level->code_id)))
	//if(!empty($discount_code))
		return $level;

	//this is an array of level ids this renewal offer is available for and the renewal cost for each
	$discounts = array(
		4 => 240,
		6 => 495,
		44 => 869,
		48 => 869,
		49 => 25,
		50 => 50

	);

	//only if you already have the level
	if(pmpro_hasMembershipLevel($level->id) && in_array($level->id, array_keys($discounts)))
	{
		//check if an array or else (number) was given
		if(is_array($discounts[$level->id]))
		{
			//adjust each value
			foreach($discounts[$level->id] as $key => $value)
			{
				$level->$key = $value;
			}
		}
		else
		{
			//assume the initial price is meant
			$level->initial_payment = $discounts[$level->id];
		}
	}

	return $level;
}
add_filter('pmpro_checkout_level', 'erd_pmpro_checkout_level');


function add_user_contactmethods ( $user_contactmethods ) {
	$user_contactmethods['instagram'] = 'Instagram URL';
	return $user_contactmethods;
}

add_filter( 'user_contactmethods', 'add_user_contactmethods' );


/**
 * Tell PMPro to look for templates in this plugin's templates/ folder.
 */
function my_pmpro_pages_custom_template_path( $templates, $page_name ) {
	$templates[] = plugin_dir_path(__FILE__) . 'templates/' . $page_name . '.php';

	return $templates;
}
add_filter( 'pmpro_pages_custom_template_path', 'my_pmpro_pages_custom_template_path', 10, 2 );

function my_pmpro_disable_member_emails($recipient, $email)
{
	$user = get_user_by('login', $email->data['user_login']);
	$level = pmpro_getMembershipLevelForUser($user->ID);

	if(!empty($level) && !empty($level->id) && $level->id == 30) //disable emails to level 1 only
  		$recipient = NULL;

	return $recipient;
}
add_filter("pmpro_email_recipient", "my_pmpro_disable_member_emails", 10, 2);



/*
 * Only show the Membership Card link on the account page if
 * the user has specific membership levels.
 */
function my_pmpro_hide_membership_card_link() {
	$membership_card_levels = array( '4', '6', '12', '24', '32', '39', '34', '40', '43', '44', '47', '48','49','50'); // Change these values to the levels that should see link
	if ( ! pmpro_hasMembershipLevel( $membership_card_levels ) ) {
		remove_action("pmpro_member_links_top", "pmpro_membership_card_member_links_top");
	}
}
add_action("pmpro_member_links_top", "my_pmpro_hide_membership_card_link", 9);





//remove "sponsored members" from text

/*
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 * A simple gist that changes "Pay by Check" to "Pay by Cheque or Bank Transfer:".
 * Copy the code below into your PMPro Customizations Plugin -
https://www.paidmembershipspro.com/create-a-plugin-for-pmpro-customizations/
 */


function my_gettext_membership( $translated_text, $text, $domain ) {
	if ( $domain == 'pmpro-sponsored-members' ) {
		$translated_text = str_replace( 'Sponsored Members', 'Sub-Agents', $translated_text );
		$translated_text = str_replace( 'sponsored members', 'Sub-Agents', $translated_text );
		$translated_text = str_replace( 'sponsored', 'sub-agent', $translated_text );
		$translated_text = str_replace( 'Sponsored', 'Sub-Agent', $translated_text );
		$translated_text = str_replace( 'sponsor', 'sub-agent', $translated_text );
		$translated_text = str_replace( 'Sponsor', 'Sub-Agent', $translated_text );
	}

	return $translated_text;
}
add_filter( 'gettext', 'my_gettext_membership', 10, 3 );

function my_pmpro_checkout_level( $checkout_level ) {


    global $current_user;
    $user_id = $current_user->ID;
    // Get user's current level.
    $user_level = pmpro_getMembershipLevelForUser();

	$excluded_levels = Array(7, 19, 20, 36, 47, 12);

	// Bail if there is no level or checking out for the same level.
    if ( empty ( $user_level ) || $user_level->id == $checkout_level->id || $user_level->expiration_period != 'Day') {
        return $checkout_level;
    }

	// Bail if there are checking out for or upgrading too an excluded level

	if (in_array($user_level->id,$excluded_levels) || in_array($checkout_level->id,$excluded_levels)) {
		return $checkout_level;
	}

	$enddate = $user_level->enddate;
    $now = time();
    $days = round(($enddate - $now) / (60 * 60 * 24));
    if ( $days < 0) {
	return $checkout_level;
    }
    if ($user_level->expiration_number > 0) {
	$daily_rate = round($user_level->initial_payment / $user_level->expiration_number, 2);
	$discount = $days * $daily_rate;

	$prorated_cost = $checkout_level->initial_payment - $discount;




    // Calculate prorated cost based on current level settings.
    $checkout_level->initial_payment = max( $prorated_cost, 0 );
    }
    return $checkout_level;
}

add_filter( 'pmpro_checkout_level', 'my_pmpro_checkout_level' );

function pmprosd_pmpro_profile_start_date_modified( $start_date, $order) {
	global $current_user;
	$user_id = $current_user->ID;
    $user_level = pmpro_getMembershipLevelForUser();
	$all_levels = pmpro_getAllLevels();
	$checkout_level = $all_levels[$order->membership_id];

	$excluded_levels = Array(7, 19, 20, 36, 47);



	if ( empty ( $user_level ) || $user_level->id == $checkout_level->id || $user_level->expiration_period != 'Day') {
        return $start_date;
    }

	if (in_array($user_level->id,$excluded_levels) || in_array($checkout_level->id,$excluded_levels)) {
		return $start_date;
	}





	if($checkout_level->cycle_period == 'Month' && $user_level->expiration_period == 'Day') {
		$enddate = $user_level->enddate;
		$now = time();
		$days = round(($enddate - $now) / (60 * 60 * 24));

		if ( $days < 0) {
		return $start_date;
		}

		$daily_rate = round($user_level->initial_payment / $user_level->expiration_number, 2);
		$discount = ($days * $daily_rate) - $checkout_level->initial_payment;

		if ($discount > 0) {
		$paid_time_months = $discount / $checkout_level->billing_amount;
		$paid_time_seconds = $paid_time_months * 30 * 24 * 60 * 60;

	    $str_start_date = str_replace("T0:0:0","",$start_date);

		$d = strtotime($str_start_date);

		$d += $paid_time_seconds;
		$start_date = date("Y-m-d", $d)."T0:0:0";

		}
	}

	return $start_date;
}

add_filter( 'pmpro_profile_start_date', 'pmprosd_pmpro_profile_start_date_modified', 11, 2 );


/**
 * This recipe description
 *
 * You can add this recipe to your site by creating a custom plugin
 * or using the Code Snippets plugin available for free in the WordPress repository.
 * Read this companion article for step-by-step directions on either method.
 * https://www.paidmembershipspro.com/create-a-plugin-for-pmpro-customizations/
 */

function pmpropbc_pmpro_has_membership_access_filter_temp_swop() {
	// Let's first check if Pay By Check is active.
	if ( ! defined( 'PMPRO_PAY_BY_CHECK_DIR' ) || ! defined( 'PMPROPBC_VER' ) ) {
		return;
	}

	if ( '0.10' === PMPROPBC_VER ) {
		remove_filter( 'pmpro_member_shortcode_access', 'pmpropbc_pmpro_member_shortcode_access' );
		add_filter( 'pmpro_member_shortcode_access', 'my_pmpropbc_pmpro_member_shortcode_access_temp_patch', 10, 4 );
	}

}
add_action( 'init', 'pmpropbc_pmpro_has_membership_access_filter_temp_swop' );

function my_pmpropbc_pmpro_member_shortcode_access_temp_patch( $hasaccess, $content, $levels, $delay ) {
	global $current_user;
	// If they don't have a access already, just bail.
	if ( ! $hasaccess ) {
		return $hasaccess;
	}

	// Let's check level access for logged in Users.
	if ( is_user_logged_in() ) {
		$hasaccess = pmprobpc_memberHasAccessWithAnyLevel( $current_user->ID );
	}

	return $hasaccess;
}

?>
