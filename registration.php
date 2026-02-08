<?php
include_once "./config/config.inc.php";
?>

<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<head>
    <meta charset="utf-8">
    <title>Registration | Subtech</title>
	<meta name="title" content=" Registration | Subtech ">
	 <meta name="description" content="Welcome to Subtech. Registration">

		
		<?php include_once"config/head.php";?>
	
	
	
    <style>
        
        .form-container {
    max-width: 800px;
    margin: 15px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #video-preview, #photo-canvas { max-width: 100%; border-radius: 5px; }
        #photo-canvas { display: none; }
        .form-section-title { margin-bottom: 1.5rem; border-bottom: 1px solid #dee2e6; padding-bottom: 0.5rem; }
    </style>
</head>
<body>

<div class="">
    <div class="form-container">
		<div class="text-center">	<img src="https://subtech.in/images/logo/logo.png"><br><br></div>
           <h5 class="title text-center mb-4" data-key="formTitle">
		  Distributor, Dealer, Technician Inquiry</h5>
		   
		   
        <form id="registrationForm" class="needs-validation" novalidate>
            <input type="hidden" name="_token" value="<?=$post_id?>" />
			<input type="hidden" name="method" value="registration" />
             <!--<h3 class="sub text-md form-section-title" data-key="personalInfoTitle">Personal Information</h3>-->
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label d-block" data-key="selectLangLabel">Select Language</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="language" id="langEnglish" value="en" checked>
                        <label class="form-check-label" for="langEnglish">English</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="language" id="langHindi" value="hi">
                        <label class="form-check-label" for="langHindi">हिन्दी</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label for="mobileNumber" class="form-label" data-key="mobileLabel">Mobile Number <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">+91</span>
                        <input type="text" class="form-control onlynumber" id="mobileNumber"  placeholder="" pattern="[6-9][0-9]{10}" name="mobile" maxlength="10" required>
                        <!--<button class="btn btn-secondary" type="button" id="sendOtpBtn" data-key="sendOtpBtn">Send OTP</button>-->
                        <div class="invalid-feedback" data-key="mobileInvalidFeedback">Please enter a valid 10-digit mobile number.</div>
                    </div>
                </div>
               <!-- <div class="col-md-5">
                    <label for="otp" class="form-label" data-key="otpLabel">Enter OTP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="otp" pattern="\d{6}" data-key-placeholder="otpPlaceholder" placeholder="6-digit OTP" required>
                    <div class="invalid-feedback" data-key="otpInvalidFeedback">Please enter the 6-digit OTP.</div>
                </div>-->
                
                <div class="col-md-6">
                    <label for="firstName" class="form-label" data-key="firstNameLabel">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control name" name="name" id="firstName" required>
                    <div class="invalid-feedback" data-key="firstNameInvalidFeedback">Name is required.</div>
                </div>
                <!--<div class="col-md-4">
                    <label for="lastName" class="form-label" data-key="lastNameLabel">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastName" required>
                    <div class="invalid-feedback" data-key="lastNameInvalidFeedback">Last name is required.</div>
                </div>

                <div class="col-md-6">
                    <label for="dob" class="form-label" data-key="dobLabel">Date of Birth (Optional)</label>
                    <input type="date" class="form-control" id="dob">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label" data-key="emailLabel">Email ID (Optional)</label>
                    <input type="email" class="form-control" id="email"  placeholder="">
                    <div class="invalid-feedback" data-key="emailInvalidFeedback">Please enter a valid email address.</div>
                </div>-->
            </div>

            <hr class="my-4">

              <!--<h3 class="sub text-md form-section-title" data-key="addressInfoTitle">Address Information</h6>-->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="state" class="form-label" data-key="stateLabel">State <span class="text-danger">*</span></label>
                    <select class="form-select" id="state" name="state" required>
                     </select>
                     <div class="invalid-feedback" data-key="stateInvalidFeedback">Please select a state.</div>
                </div>

                <div class="col-md-6">
                    <label for="city" class="form-label" data-key="cityLabel">City <span class="text-danger">*</span></label>
                     <select class="form-select" name="city" id="city" required disabled>
                        </select>
                    <div class="invalid-feedback" data-key="cityInvalidFeedback">Please select a city.</div>
                </div>
                
                <div class="col-12">
                     <!-- Type Selection -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark-emphasis mb-2"  data-key="regtype">Registration Type</label>
                <div class="d-flex flex-wrap gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ctype" id="typeDistributor" value="Distributor" required>
                        <label class="form-check-label" for="typeDistributor" data-key="regtype1">Distributor</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ctype" id="typeDealer" value="Dealer">
                        <label class="form-check-label" for="typeDealer" data-key="regtype2">Dealer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ctype" id="typeTechnician" value="Technician">
                        <label class="form-check-label" for="typeTechnician" data-key="regtype3">Technician</label>
                    </div>
                    <div class="invalid-feedback" data-i18n="select_type_error">Please select a registration type.</div>
                </div>
            </div>
				
				
					
					<!--<label for="address" class="form-label" data-key="addressLabel">Complete Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="address" rows="1"  placeholder="" required></textarea>
                     <div class="invalid-feedback" data-key="addressInvalidFeedback">Please enter your address.</div>-->
                </div>
            </div>
            
          
            <div id="msg1"></div>
            <hr class="my-4">
            <button class="w-100 btn btn-danger btn-lg" id="btnSubmit" type="submit" data-key="submitButton">Submit</button>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include_once 'config/foot.php';?>
<script>
$(document).ready(function(){

	var mobileverify=0;
$(".onlynumber").on("keypress",function(e){
	var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		// e.preventDefault() typing को रोक देगा
		e.preventDefault();
		return false;
	}
});
	



	$("body").on("submit","#registrationForm",function(e){
		e.preventDefault();
		$("#btnSubmit").attr("disabled",true).html("Wait...");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Master/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
			$("#btnSubmit").attr("disabled",false).html("Submit");
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#msg1").html(response.message);
					setTimeout(function(){window.location.reload();},2500);
				}else{
					$("#msg1").html(response.message);
					setTimeout(function(){$("#msg1").html('');},2500);
				}	
			}
			
		});
	});
	////////////////////
	$("body").on("keypress",".name",function(e){
		var regex = /^[a-zA-Z\s]+$/; /// remove \s for space
		var key = String.fromCharCode(e.which);
		if (!regex.test(key)) {
			e.preventDefault(); // galat character block kar dega
		}
	});
	
	
	
});


</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- DATA FOR DYNAMIC FIELDS ---
    const statesData = [
          { value: 'Andaman and Nicobar Islands', en: 'Andaman and Nicobar Islands', hi: 'अंडमान और निकोबार द्वीप समूह' },
  { value: 'Andhra Pradesh', en: 'Andhra Pradesh', hi: 'आंध्र प्रदेश' },
  { value: 'Arunachal Pradesh', en: 'Arunachal Pradesh', hi: 'अरुणाचल प्रदेश' },
  { value: 'Assam', en: 'Assam', hi: 'असम' },
  { value: 'Bihar', en: 'Bihar', hi: 'बिहार' },
  { value: 'Chandigarh', en: 'Chandigarh', hi: 'चंडीगढ़' },
  { value: 'Chhattisgarh', en: 'Chhattisgarh', hi: 'छत्तीसगढ़' },
  { value: 'Dadra and Nagar Haveli and Daman and Diu', en: 'Dadra and Nagar Haveli and Daman and Diu', hi: 'दादरा और नगर हवेली और दमन और दीव' },
  { value: 'Delhi', en: 'Delhi', hi: 'दिल्ली' },
  { value: 'Goa', en: 'Goa', hi: 'गोवा' },
  { value: 'Gujarat', en: 'Gujarat', hi: 'गुजरात' },
  { value: 'Haryana', en: 'Haryana', hi: 'हरियाणा' },
  { value: 'Himachal Pradesh', en: 'Himachal Pradesh', hi: 'हिमाचल प्रदेश' },
  { value: 'Jammu and Kashmir', en: 'Jammu and Kashmir', hi: 'जम्मू और कश्मीर' },
  { value: 'Jharkhand', en: 'Jharkhand', hi: 'झारखंड' },
  { value: 'Karnataka', en: 'Karnataka', hi: 'कर्नाटक' },
  { value: 'Kerala', en: 'Kerala', hi: 'केरल' },
  { value: 'Ladakh', en: 'Ladakh', hi: 'लद्दाख' },
  { value: 'Lakshadweep', en: 'Lakshadweep', hi: 'लक्षद्वीप' },
  { value: 'Madhya Pradesh', en: 'Madhya Pradesh', hi: 'मध्य प्रदेश' },
  { value: 'Maharashtra', en: 'Maharashtra', hi: 'महाराष्ट्र' },
  { value: 'Manipur', en: 'Manipur', hi: 'मणिपुर' },
  { value: 'Meghalaya', en: 'Meghalaya', hi: 'मेघालय' },
  { value: 'Mizoram', en: 'Mizoram', hi: 'मिज़ोरम' },
  { value: 'Nagaland', en: 'Nagaland', hi: 'नगालैंड' },
  { value: 'Odisha', en: 'Odisha', hi: 'ओडिशा' },
  { value: 'Puducherry', en: 'Puducherry', hi: 'पुदुचेरी' },
  { value: 'Punjab', en: 'Punjab', hi: 'पंजाब' },
  { value: 'Rajasthan', en: 'Rajasthan', hi: 'राजस्थान' },
  { value: 'Sikkim', en: 'Sikkim', hi: 'सिक्किम' },
  { value: 'Tamil Nadu', en: 'Tamil Nadu', hi: 'तमिलनाडु' },
  { value: 'Telangana', en: 'Telangana', hi: 'तेलंगाना' },
  { value: 'Tripura', en: 'Tripura', hi: 'त्रिपुरा' },
  { value: 'Uttar Pradesh', en: 'Uttar Pradesh', hi: 'उत्तर प्रदेश' },
  { value: 'Uttarakhand', en: 'Uttarakhand', hi: 'उत्तराखंड' },
  { value: 'West Bengal', en: 'West Bengal', hi: 'पश्चिम बंगाल' }
    ];

    
const citiesByState = {
'Andaman and Nicobar Islands': ['Diglipur', 'Mayabunder', 'Port Blair', 'Rangat'],
  'Andhra Pradesh': ['Adoni', 'Amaravati', 'Anantapur', 'Chirala', 'Chittoor', 'Eluru', 'Guntur', 'Hindupur', 'Kadapa', 'Kakinada', 'Kurnool', 'Machilipatnam', 'Madanapalle', 'Nandyal', 'Nellore', 'Ongole', 'Proddatur', 'Rajahmundry', 'Srikakulam', 'Tadepalligudem', 'Tenali', 'Tirupati', 'Vijayawada', 'Visakhapatnam', 'Vizianagaram'],
  'Arunachal Pradesh': ['Aalo', 'Bomdila', 'Itanagar', 'Pasighat', 'Tawang', 'Tezu', 'Ziro'],
  'Assam': ['Bongaigaon', 'Dhubri', 'Dibrugarh', 'Diphu', 'Goalpara', 'Guwahati', 'Jorhat', 'Nagaon', 'Silchar', 'Sivasagar', 'Tezpur', 'Tinsukia'],
  'Bihar': ['Arrah', 'Begusarai', 'Bettiah', 'Bhagalpur', 'Bihar Sharif', 'Chhapra', 'Darbhanga', 'Gaya', 'Hajipur', 'Jehanabad', 'Katihar', 'Motihari', 'Munger', 'Muzaffarpur', 'Patna', 'Purnia', 'Sasaram', 'Sitamarhi'],
  'Chandigarh': ['Chandigarh'],
  'Chhattisgarh': ['Ambikapur', 'Bhilai', 'Bilaspur', 'Dhamtari', 'Durg', 'Jagdalpur', 'Korba', 'Raigarh', 'Raipur', 'Rajnandgaon'],
  'Dadra and Nagar Haveli and Daman and Diu': ['Daman', 'Diu', 'Silvassa'],
  'Delhi': ['Delhi', 'New Delhi'],
  'Goa': ['Margao', 'Mapusa', 'Panaji', 'Ponda', 'Vasco da Gama'],
  'Gujarat': ['Ahmedabad', 'Anand', 'Bharuch', 'Bhavnagar', 'Gandhidham', 'Gandhinagar', 'Jamnagar', 'Junagadh', 'Mehsana', 'Morbi', 'Nadiad', 'Navsari', 'Porbandar', 'Rajkot', 'Surat', 'Surendranagar', 'Vadodara', 'Valsad', 'Vapi', 'Veraval'],
  'Haryana': ['Ambala', 'Bhiwani', 'Faridabad', 'Gurugram', 'Hisar', 'Jind', 'Kaithal', 'Karnal', 'Kurukshetra', 'Panchkula', 'Panipat', 'Rewari', 'Rohtak', 'Sirsa', 'Sonipat', 'Yamunanagar'],
  'Himachal Pradesh': ['Chamba', 'Dalhousie', 'Dharamshala', 'Hamirpur', 'Kullu', 'Mandi', 'Manali', 'Palampur', 'Shimla', 'Solan', 'Una'],
  'Jammu and Kashmir': ['Anantnag', 'Baramulla', 'Jammu', 'Kathua', 'Poonch', 'Rajouri', 'Sopore', 'Srinagar', 'Udhampur'],
  'Jharkhand': ['Bokaro Steel City', 'Chas', 'Deoghar', 'Dhanbad', 'Giridih', 'Hazaribagh', 'Jamshedpur', 'Medininagar', 'Ramgarh', 'Ranchi'],
  'Karnataka': ['Ballari', 'Belagavi', 'Bengaluru', 'Davanagere', 'Hassan', 'Hospet', 'Hubballi-Dharwad', 'Kalaburagi', 'Mangaluru', 'Mysuru', 'Raichur', 'Shivamogga', 'Tumakuru', 'Udupi', 'Vijayapura'],
  'Kerala': ['Alappuzha', 'Kannur', 'Kasaragod', 'Kochi', 'Kollam', 'Kottayam', 'Kozhikode', 'Malappuram', 'Palakkad', 'Thiruvananthapuram', 'Thrissur'],
  'Ladakh': ['Kargil', 'Leh'],
  'Lakshadweep': ['Agatti', 'Amini', 'Kavaratti'],
  'Madhya Pradesh': ['Bhind', 'Bhopal', 'Burhanpur', 'Chhindwara', 'Dewas', 'Guna', 'Gwalior', 'Indore', 'Jabalpur', 'Khandwa', 'Morena', 'Ratlam', 'Rewa', 'Sagar', 'Satna', 'Shivpuri', 'Singrauli', 'Ujjain', 'Vidisha'],
  'Maharashtra': ['Akola', 'Amravati', 'Aurangabad', 'Bhiwandi', 'Dhule', 'Jalgaon', 'Kolhapur', 'Latur', 'Malegaon', 'Mumbai', 'Nagpur', 'Nanded', 'Nashik', 'Navi Mumbai', 'Parbhani', 'Pune', 'Sangli', 'Satara', 'Solapur', 'Thane', 'Wardha', 'Yavatmal'],
  'Manipur': ['Churachandpur', 'Imphal', 'Thoubal'],
  'Meghalaya': ['Jowai', 'Nongpoh', 'Shillong', 'Tura'],
  'Mizoram': ['Aizawl', 'Champhai', 'Lunglei'],
  'Nagaland': ['Dimapur', 'Kohima', 'Mokokchung', 'Wokha', 'Zunheboto'],
  'Odisha': ['Balasore', 'Baripada', 'Berhampur', 'Bhadrak', 'Bhubaneswar', 'Cuttack', 'Jharsuguda', 'Puri', 'Rourkela', 'Sambalpur'],
  'Puducherry': ['Karaikal', 'Mahe', 'Puducherry', 'Yanam'],
  'Punjab': ['Amritsar', 'Bathinda', 'Firozpur', 'Hoshiarpur', 'Jalandhar', 'Kapurthala', 'Ludhiana', 'Moga', 'Mohali', 'Patiala', 'Pathankot', 'Phagwara'],
  'Rajasthan': ['Ajmer', 'Alwar', 'Bharatpur', 'Bhilwara', 'Bikaner', 'Chittorgarh', 'Hanumangarh', 'Jaipur', 'Jodhpur', 'Kishangarh', 'Kota', 'Pali', 'Sikar', 'Sri Ganganagar', 'Tonk', 'Udaipur'],
  'Sikkim': ['Gangtok', 'Gyalshing', 'Mangan', 'Namchi'],
  'Tamil Nadu': ['Chennai', 'Coimbatore', 'Dindigul', 'Erode', 'Hosur', 'Kanchipuram', 'Kanyakumari', 'Madurai', 'Nagercoil', 'Ooty', 'Pollachi', 'Rameswaram', 'Salem', 'Thanjavur', 'Thoothukudi', 'Tiruchirappalli', 'Tirunelveli', 'Tiruppur', 'Vellore'],
  'Telangana': ['Adilabad', 'Hyderabad', 'Karimnagar', 'Khammam', 'Mahbubnagar', 'Nizamabad', 'Ramagundam', 'Siddipet', 'Suryapet', 'Warangal'],
  'Tripura': ['Agartala', 'Dharmanagar', 'Kailasahar', 'Udaipur'],
  'Uttar Pradesh': ['Agra', 'Aligarh', 'Amroha', 'Ayodhya', 'Bahraich', 'Banda', 'Bareilly', 'Budaun', 'Bulandshahr', 'Etawah', 'Farrukhabad', 'Fatehpur', 'Firozabad', 'Ghaziabad', 'Gonda', 'Gorakhpur', 'Hapur', 'Hardoi', 'Hathras', 'Jaunpur', 'Jhansi', 'Kanpur', 'Lakhimpur', 'Lalitpur', 'Lucknow', 'Mainpuri', 'Mathura', 'Meerut', 'Mirzapur', 'Moradabad', 'Mughalsarai', 'Muzaffarnagar', 'Noida', 'Orai', 'Pilibhit', 'Prayagraj', 'Raebareli', 'Rampur', 'Saharanpur', 'Sambhal', 'Shahjahanpur', 'Sitapur', 'Unnao', 'Varanasi'],
  'Uttarakhand': ['Almora', 'Dehradun', 'Haldwani', 'Haridwar', 'Kashipur', 'Nainital', 'Pithoragarh', 'Rishikesh', 'Roorkee', 'Rudrapur'],
  'West Bengal': ['Asansol', 'Baharampur', 'Bankura', 'Bardhaman', 'Cooch Behar', 'Darjeeling', 'Durgapur', 'Haldia', 'Howrah', 'Jalpaiguri', 'Kharagpur', 'Kolkata', 'Krishnanagar', 'Malda', 'Purulia', 'Shantipur', 'Siliguri']
};



const cityTranslations = {
    // Andaman and Nicobar Islands
    'Port Blair': { en: 'Port Blair', hi: 'पोर्ट ब्लेयर' },
    'Diglipur': { en: 'Diglipur', hi: 'दिगलीपुर' },
    'Mayabunder': { en: 'Mayabunder', hi: 'मायाबंदर' },
    'Rangat': { en: 'Rangat', hi: 'रंगत' },
    // Andhra Pradesh
    'Visakhapatnam': { en: 'Visakhapatnam', hi: 'विशाखापत्तनम' },
    'Vijayawada': { en: 'Vijayawada', hi: 'विजयवाड़ा' },
    'Tirupati': { en: 'Tirupati', hi: 'तिरुपति' },
    'Guntur': { en: 'Guntur', hi: 'गुंटूर' },
    'Nellore': { en: 'Nellore', hi: 'नेल्लोर' },
    'Kurnool': { en: 'Kurnool', hi: 'कुरनूल' },
    'Kakinada': { en: 'Kakinada', hi: 'काकीनाडा' },
    'Rajahmundry': { en: 'Rajahmundry', hi: 'राजमुंदरी' },
    'Anantapur': { en: 'Anantapur', hi: 'अनंतपुर' },
    'Chittoor': { en: 'Chittoor', hi: 'चित्तूर' },
    'Eluru': { en: 'Eluru', hi: 'एलुरु' },
    'Kadapa': { en: 'Kadapa', hi: 'कडपा' },
    'Machilipatnam': { en: 'Machilipatnam', hi: 'मछलीपट्टनम' },
    'Ongole': { en: 'Ongole', hi: 'ओंगोल' },
    'Srikakulam': { en: 'Srikakulam', hi: 'श्रीकाकुलम' },
    'Vizianagaram': { en: 'Vizianagaram', hi: 'विजयनगरम' },
    'Adoni': { en: 'Adoni', hi: 'अदोनी' },
    'Amaravati': { en: 'Amaravati', hi: 'अमरावती' },
    'Chirala': { en: 'Chirala', hi: 'चिराला' },
    'Hindupur': { en: 'Hindupur', hi: 'हिंदूपुर' },
    'Madanapalle': { en: 'Madanapalle', hi: 'मदनपल्ले' },
    'Nandyal': { en: 'Nandyal', hi: 'नांदयाल' },
    'Proddatur': { en: 'Proddatur', hi: 'प्रొద్దుटूर' },
    'Tadepalligudem': { en: 'Tadepalligudem', hi: 'ताडेपल्लीगुडेम' },
    'Tenali': { en: 'Tenali', hi: 'तेनाली' },
    // Arunachal Pradesh
    'Itanagar': { en: 'Itanagar', hi: 'ईटानगर' },
    'Tawang': { en: 'Tawang', hi: 'तवांग' },
    'Aalo': { en: 'Aalo', hi: 'आलो' },
    'Bomdila': { en: 'Bomdila', hi: 'बोमडिला' },
    'Pasighat': { en: 'Pasighat', hi: 'पासीघाट' },
    'Tezu': { en: 'Tezu', hi: 'तेजू' },
    'Ziro': { en: 'Ziro', hi: 'जिरो' },
    // Assam
    'Guwahati': { en: 'Guwahati', hi: 'गुवाहाटी' },
    'Dibrugarh': { en: 'Dibrugarh', hi: 'डिब्रूगढ़' },
    'Silchar': { en: 'Silchar', hi: 'सिलचर' },
    'Jorhat': { en: 'Jorhat', hi: 'जोरहाट' },
    'Nagaon': { en: 'Nagaon', hi: 'नगांव' },
    'Tezpur': { en: 'Tezpur', hi: 'तेजपुर' },
    'Tinsukia': { en: 'Tinsukia', hi: 'तिनसुकिया' },
    'Bongaigaon': { en: 'Bongaigaon', hi: 'बोंगईगांव' },
    'Dhubri': { en: 'Dhubri', hi: 'धुबरी' },
    'Diphu': { en: 'Diphu', hi: 'दीफू' },
    'Goalpara': { en: 'Goalpara', hi: 'गोलपारा' },
    'Sivasagar': { en: 'Sivasagar', hi: 'शिवसागर' },
    // Bihar
    'Patna': { en: 'Patna', hi: 'पटना' },
    'Gaya': { en: 'Gaya', hi: 'गया' },
    'Bhagalpur': { en: 'Bhagalpur', hi: 'भागलपुर' },
    'Muzaffarpur': { en: 'Muzaffarpur', hi: 'मुजफ्फरपुर' },
    'Purnia': { en: 'Purnia', hi: 'पूर्णिया' },
    'Darbhanga': { en: 'Darbhanga', hi: 'दरभंगा' },
    'Arrah': { en: 'Arrah', hi: 'आरा' },
    'Begusarai': { en: 'Begusarai', hi: 'बेगूसराय' },
    'Bettiah': { en: 'Bettiah', hi: 'बेतिया' },
    'Bihar Sharif': { en: 'Bihar Sharif', hi: 'बिहार शरीफ' },
    'Chhapra': { en: 'Chhapra', hi: 'छपरा' },
    'Hajipur': { en: 'Hajipur', hi: 'हाजीपुर' },
    'Jehanabad': { en: 'Jehanabad', hi: 'जहानाबाद' },
    'Katihar': { en: 'Katihar', hi: 'कटिहार' },
    'Motihari': { en: 'Motihari', hi: 'मोतिहारी' },
    'Munger': { en: 'Munger', hi: 'मुंगेर' },
    'Sasaram': { en: 'Sasaram', hi: 'सासाराम' },
    'Sitamarhi': { en: 'Sitamarhi', hi: 'सीतामढ़ी' },
    // Chandigarh
    'Chandigarh': { en: 'Chandigarh', hi: 'चंडीगढ़' },
    // Chhattisgarh
    'Raipur': { en: 'Raipur', hi: 'रायपुर' },
    'Bhilai': { en: 'Bhilai', hi: 'भिलाई' },
    'Bilaspur': { en: 'Bilaspur', hi: 'बिलासपुर' },
    'Korba': { en: 'Korba', hi: 'कोरबा' },
    'Durg': { en: 'Durg', hi: 'दुर्ग' },
    'Jagdalpur': { en: 'Jagdalpur', hi: 'जगदलपुर' },
    'Raigarh': { en: 'Raigarh', hi: 'रायगढ़' },
    'Rajnandgaon': { en: 'Rajnandgaon', hi: 'राजनांदगांव' },
    'Ambikapur': { en: 'Ambikapur', hi: 'अंबिकापुर' },
    'Dhamtari': { en: 'Dhamtari', hi: 'धमतरी' },
    // Dadra and Nagar Haveli and Daman and Diu
    'Daman': { en: 'Daman', hi: 'दमन' },
    'Silvassa': { en: 'Silvassa', hi: 'सिलवासा' },
    'Diu': { en: 'Diu', hi: 'दीव' },
    // Delhi
    'New Delhi': { en: 'New Delhi', hi: 'नई दिल्ली' },
    'Delhi': { en: 'Delhi', hi: 'दिल्ली' },
    // Goa
    'Panaji': { en: 'Panaji', hi: 'पणजी' },
    'Vasco da Gama': { en: 'Vasco da Gama', hi: 'वास्को डी गामा' },
    'Margao': { en: 'Margao', hi: 'मडगांव' },
    'Mapusa': { en: 'Mapusa', hi: 'मापुसा' },
    'Ponda': { en: 'Ponda', hi: 'पोंडा' },
    // Gujarat
    'Ahmedabad': { en: 'Ahmedabad', hi: 'अहमदाबाद' },
    'Surat': { en: 'Surat', hi: 'सूरत' },
    'Vadodara': { en: 'Vadodara', hi: 'वडोदरा' },
    'Rajkot': { en: 'Rajkot', hi: 'राजकोट' },
    'Bhavnagar': { en: 'Bhavnagar', hi: 'भावनगर' },
    'Jamnagar': { en: 'Jamnagar', hi: 'जामनगर' },
    'Gandhinagar': { en: 'Gandhinagar', hi: 'गांधीनगर' },
    'Junagadh': { en: 'Junagadh', hi: 'जूनागढ़' },
    'Anand': { en: 'Anand', hi: 'आनंद' },
    'Bharuch': { en: 'Bharuch', hi: 'भरूच' },
    'Gandhidham': { en: 'Gandhidham', hi: 'गांधीधाम' },
    'Mehsana': { en: 'Mehsana', hi: 'मेहसाणा' },
    'Morbi': { en: 'Morbi', hi: 'मोरबी' },
    'Nadiad': { en: 'Nadiad', hi: 'नडियाद' },
    'Navsari': { en: 'Navsari', hi: 'नवसारी' },
    'Porbandar': { en: 'Porbandar', hi: 'पोरबंदर' },
    'Surendranagar': { en: 'Surendranagar', hi: 'सुरेंद्रनगर' },
    'Valsad': { en: 'Valsad', hi: 'वलसाड' },
    'Veraval': { en: 'Veraval', hi: 'वेरावल' },
    'Vapi': { en: 'Vapi', hi: 'वापी' },
    // Haryana
    'Faridabad': { en: 'Faridabad', hi: 'फरीदाबाद' },
    'Gurugram': { en: 'Gurugram', hi: 'गुरुग्राम' },
    'Panipat': { en: 'Panipat', hi: 'पानीपत' },
    'Ambala': { en: 'Ambala', hi: 'अंबाला' },
    'Hisar': { en: 'Hisar', hi: 'हिसार' },
    'Rohtak': { en: 'Rohtak', hi: 'रोहतक' },
    'Karnal': { en: 'Karnal', hi: 'करनाल' },
    'Sonipat': { en: 'Sonipat', hi: 'सोनीपत' },
    'Yamunanagar': { en: 'Yamunanagar', hi: 'यमुनानगर' },
    'Panchkula': { en: 'Panchkula', hi: 'पंचकुला' },
    'Bhiwani': { en: 'Bhiwani', hi: 'भिवानी' },
    'Jind': { en: 'Jind', hi: 'जींद' },
    'Kaithal': { en: 'Kaithal', hi: 'कैथल' },
    'Kurukshetra': { en: 'Kurukshetra', hi: 'कुरुक्षेत्र' },
    'Rewari': { en: 'Rewari', hi: 'रेवाड़ी' },
    'Sirsa': { en: 'Sirsa', hi: 'सिरसा' },
    // Himachal Pradesh
    'Shimla': { en: 'Shimla', hi: 'शिमला' },
    'Manali': { en: 'Manali', hi: 'मनाली' },
    'Dharamshala': { en: 'Dharamshala', hi: 'धर्मशाला' },
    'Solan': { en: 'Solan', hi: 'सोलन' },
    'Kullu': { en: 'Kullu', hi: 'कुल्लू' },
    'Mandi': { en: 'Mandi', hi: 'मंडी' },
    'Palampur': { en: 'Palampur', hi: 'पालमपुर' },
    'Chamba': { en: 'Chamba', hi: 'चंबा' },
    'Hamirpur': { en: 'Hamirpur', hi: 'हमीरपुर' },
    'Una': { en: 'Una', hi: 'ऊना' },
    'Dalhousie': { en: 'Dalhousie', hi: 'डलहौजी' },
    // Jammu and Kashmir
    'Srinagar': { en: 'Srinagar', hi: 'श्रीनगर' },
    'Jammu': { en: 'Jammu', hi: 'जम्मू' },
    'Anantnag': { en: 'Anantnag', hi: 'अनंतनाग' },
    'Baramulla': { en: 'Baramulla', hi: 'बारामूला' },
    'Kathua': { en: 'Kathua', hi: 'कठुआ' },
    'Sopore': { en: 'Sopore', hi: 'सोपोर' },
    'Udhampur': { en: 'Udhampur', hi: 'उधमपुर' },
    'Poonch': { en: 'Poonch', hi: 'पुंछ' },
    'Rajouri': { en: 'Rajouri', hi: 'राजौरी' },
    // Jharkhand
    'Ranchi': { en: 'Ranchi', hi: 'रांची' },
    'Jamshedpur': { en: 'Jamshedpur', hi: 'जमशेदपुर' },
    'Dhanbad': { en: 'Dhanbad', hi: 'धनबाद' },
    'Bokaro Steel City': { en: 'Bokaro Steel City', hi: 'बोकारो स्टील सिटी' },
    'Deoghar': { en: 'Deoghar', hi: 'देवघर' },
    'Hazaribagh': { en: 'Hazaribagh', hi: 'हजारीबाग' },
    'Giridih': { en: 'Giridih', hi: 'गिरिडीह' },
    'Ramgarh': { en: 'Ramgarh', hi: 'रामगढ़' },
    'Medininagar': { en: 'Medininagar', hi: 'मेदिनीनगर' },
    'Chas': { en: 'Chas', hi: 'चास' },
    // Karnataka
    'Bengaluru': { en: 'Bengaluru', hi: 'बेंगलुरु' },
    'Mysuru': { en: 'Mysuru', hi: 'मैसूर' },
    'Hubballi-Dharwad': { en: 'Hubballi-Dharwad', hi: 'हुबली-धारवाड़' },
    'Mangaluru': { en: 'Mangaluru', hi: 'मंगलुरु' },
    'Belagavi': { en: 'Belagavi', hi: 'बेलगावी' },
    'Ballari': { en: 'Ballari', hi: 'बल्लारी' },
    'Davanagere': { en: 'Davanagere', hi: 'दावणगेरे' },
    'Shivamogga': { en: 'Shivamogga', hi: 'शिवमोग्गा' },
    'Tumakuru': { en: 'Tumakuru', hi: 'तुमकुरु' },
    'Udupi': { en: 'Udupi', hi: 'उडुपी' },
    'Vijayapura': { en: 'Vijayapura', hi: 'विजयपुर' },
    'Kalaburagi': { en: 'Kalaburagi', hi: 'कलबुर्गी' },
    'Hassan': { en: 'Hassan', hi: 'हसन' },
    'Hospet': { en: 'Hospet', hi: 'होस्पेट' },
    'Raichur': { en: 'Raichur', hi: 'रायचूर' },
    // Kerala
    'Thiruvananthapuram': { en: 'Thiruvananthapuram', hi: 'तिरुवनंतपुरम' },
    'Kochi': { en: 'Kochi', hi: 'कोच्चि' },
    'Kozhikode': { en: 'Kozhikode', hi: 'कोषिक्कोड' },
    'Thrissur': { en: 'Thrissur', hi: 'त्रिशूर' },
    'Kollam': { en: 'Kollam', hi: 'कोल्लम' },
    'Alappuzha': { en: 'Alappuzha', hi: 'अलाप्पुझा' },
    'Kannur': { en: 'Kannur', hi: 'कन्नूर' },
    'Kottayam': { en: 'Kottayam', hi: 'कोट्टयम' },
    'Palakkad': { en: 'Palakkad', hi: 'पलक्कड़' },
    'Malappuram': { en: 'Malappuram', hi: 'मलप्पुरम' },
    'Kasaragod': { en: 'Kasaragod', hi: 'कासरगोड' },
    // Ladakh
    'Leh': { en: 'Leh', hi: 'लेह' },
    'Kargil': { en: 'Kargil', hi: 'कारगिल' },
    // Lakshadweep
    'Kavaratti': { en: 'Kavaratti', hi: 'कवरत्ती' },
    'Agatti': { en: 'Agatti', hi: 'अगाती' },
    'Amini': { en: 'Amini', hi: 'अमिनी' },
    // Madhya Pradesh
    'Indore': { en: 'Indore', hi: 'इंदौर' },
    'Bhopal': { en: 'Bhopal', hi: 'भोपाल' },
    'Jabalpur': { en: 'Jabalpur', hi: 'जबलपुर' },
    'Gwalior': { en: 'Gwalior', hi: 'ग्वालियर' },
    'Ujjain': { en: 'Ujjain', hi: 'उज्जैन' },
    'Sagar': { en: 'Sagar', hi: 'सागर' },
    'Dewas': { en: 'Dewas', hi: 'देवास' },
    'Satna': { en: 'Satna', hi: 'सतना' },
    'Ratlam': { en: 'Ratlam', hi: 'रतलाम' },
    'Rewa': { en: 'Rewa', hi: 'रीवा' },
    'Singrauli': { en: 'Singrauli', hi: 'सिंगरौली' },
    'Burhanpur': { en: 'Burhanpur', hi: 'बुरहानपुर' },
    'Khandwa': { en: 'Khandwa', hi: 'खंडवा' },
    'Morena': { en: 'Morena', hi: 'मुरैना' },
    'Bhind': { en: 'Bhind', hi: 'भिंड' },
    'Chhindwara': { en: 'Chhindwara', hi: 'छिंदवाड़ा' },
    'Guna': { en: 'Guna', hi: 'गुना' },
    'Shivpuri': { en: 'Shivpuri', hi: 'शिवपुरी' },
    'Vidisha': { en: 'Vidisha', hi: 'विदिशा' },
    // Maharashtra
    'Mumbai': { en: 'Mumbai', hi: 'मुंबई' },
    'Pune': { en: 'Pune', hi: 'पुणे' },
    'Nagpur': { en: 'Nagpur', hi: 'नागपुर' },
    'Thane': { en: 'Thane', hi: 'ठाणे' },
    'Nashik': { en: 'Nashik', hi: 'नासिक' },
    'Aurangabad': { en: 'Aurangabad', hi: 'औरंगाबाद' },
    'Solapur': { en: 'Solapur', hi: 'सोलापुर' },
    'Kolhapur': { en: 'Kolhapur', hi: 'कोल्हापुर' },
    'Navi Mumbai': { en: 'Navi Mumbai', hi: 'नवी मुंबई' },
    'Amravati': { en: 'Amravati', hi: 'अमरावती' },
    'Akola': { en: 'Akola', hi: 'अकोला' },
    'Bhiwandi': { en: 'Bhiwandi', hi: 'भिवंडी' },
    'Dhule': { en: 'Dhule', hi: 'धुले' },
    'Jalgaon': { en: 'Jalgaon', hi: 'जलगांव' },
    'Latur': { en: 'Latur', hi: 'लातूर' },
    'Malegaon': { en: 'Malegaon', hi: 'मालेगांव' },
    'Nanded': { en: 'Nanded', hi: 'नांदेड़' },
    'Parbhani': { en: 'Parbhani', hi: 'परभणी' },
    'Sangli': { en: 'Sangli', hi: 'सांगली' },
    'Satara': { en: 'Satara', hi: 'सतारा' },
    'Wardha': { en: 'Wardha', hi: 'वर्धा' },
    'Yavatmal': { en: 'Yavatmal', hi: 'यवतमाल' },
    // Manipur
    'Imphal': { en: 'Imphal', hi: 'इम्फाल' },
    'Churachandpur': { en: 'Churachandpur', hi: 'चुराचांदपुर' },
    'Thoubal': { en: 'Thoubal', hi: 'थौबल' },
    // Meghalaya
    'Shillong': { en: 'Shillong', hi: 'शिलांग' },
    'Tura': { en: 'Tura', hi: 'तुरा' },
    'Jowai': { en: 'Jowai', hi: 'जोवाई' },
    'Nongpoh': { en: 'Nongpoh', hi: 'नोंगपोह' },
    // Mizoram
    'Aizawl': { en: 'Aizawl', hi: 'आइजोल' },
    'Lunglei': { en: 'Lunglei', hi: 'लुंगलेई' },
    'Champhai': { en: 'Champhai', hi: 'चम्फाई' },
    // Nagaland
    'Kohima': { en: 'Kohima', hi: 'कोहिमा' },
    'Dimapur': { en: 'Dimapur', hi: 'दीमापुर' },
    'Mokokchung': { en: 'Mokokchung', hi: 'मोकोकचुंग' },
    'Wokha': { en: 'Wokha', hi: 'वोखा' },
    'Zunheboto': { en: 'Zunheboto', hi: 'ज़ुन्हेबोटो' },
    // Odisha
    'Bhubaneswar': { en: 'Bhubaneswar', hi: 'भुवनेश्वर' },
    'Cuttack': { en: 'Cuttack', hi: 'कटक' },
    'Rourkela': { en: 'Rourkela', hi: 'राउरकेला' },
    'Puri': { en: 'Puri', hi: 'पुरी' },
    'Sambalpur': { en: 'Sambalpur', hi: 'संबलपुर' },
    'Berhampur': { en: 'Berhampur', hi: 'बेरहामपुर' },
    'Balasore': { en: 'Balasore', hi: 'बालासोर' },
    'Bhadrak': { en: 'Bhadrak', hi: 'भद्रक' },
    'Baripada': { en: 'Baripada', hi: 'बारिपदा' },
    'Jharsuguda': { en: 'Jharsuguda', hi: 'झारसुगुड़ा' },
    // Puducherry
    'Puducherry': { en: 'Puducherry', hi: 'पुदुचेरी' },
    'Karaikal': { en: 'Karaikal', hi: 'कराइकल' },
    'Mahe': { en: 'Mahe', hi: 'माहे' },
    'Yanam': { en: 'Yanam', hi: 'यनम' },
    // Punjab
    'Ludhiana': { en: 'Ludhiana', hi: 'लुधियाना' },
    'Amritsar': { en: 'Amritsar', hi: 'अमृतसर' },
    'Jalandhar': { en: 'Jalandhar', hi: 'जालंधर' },
    'Patiala': { en: 'Patiala', hi: 'पटियाला' },
    'Bathinda': { en: 'Bathinda', hi: 'बठिंडा' },
    'Hoshiarpur': { en: 'Hoshiarpur', hi: 'होशियारपुर' },
    'Mohali': { en: 'Mohali', hi: 'मोहाली' },
    'Pathankot': { en: 'Pathankot', hi: 'पठानकोट' },
    'Moga': { en: 'Moga', hi: 'मोगा' },
    'Firozpur': { en: 'Firozpur', hi: 'फिरोजपुर' },
    'Kapurthala': { en: 'Kapurthala', hi: 'कपूरथला' },
    'Phagwara': { en: 'Phagwara', hi: 'फगवाड़ा' },
    // Rajasthan
    'Jaipur': { en: 'Jaipur', hi: 'जयपुर' },
    'Jodhpur': { en: 'Jodhpur', hi: 'जोधपुर' },
    'Udaipur': { en: 'Udaipur', hi: 'उदयपुर' },
    'Kota': { en: 'Kota', hi: 'कोटा' },
    'Bikaner': { en: 'Bikaner', hi: 'बीकानेर' },
    'Ajmer': { en: 'Ajmer', hi: 'अजमेर' },
    'Alwar': { en: 'Alwar', hi: 'अलवर' },
    'Bhilwara': { en: 'Bhilwara', hi: 'भीलवाड़ा' },
    'Sri Ganganagar': { en: 'Sri Ganganagar', hi: 'श्री गंगानगर' },
    'Sikar': { en: 'Sikar', hi: 'सीकर' },
    'Pali': { en: 'Pali', hi: 'पाली' },
    'Bharatpur': { en: 'Bharatpur', hi: 'भरतपुर' },
    'Chittorgarh': { en: 'Chittorgarh', hi: 'चित्तौड़गढ़' },
    'Hanumangarh': { en: 'Hanumangarh', hi: 'हनुमानगढ़' },
    'Kishangarh': { en: 'Kishangarh', hi: 'किशनगढ़' },
    'Tonk': { en: 'Tonk', hi: 'टोंक' },
    // Sikkim
    'Gangtok': { en: 'Gangtok', hi: 'गंगटोक' },
    'Namchi': { en: 'Namchi', hi: 'नामची' },
    'Gyalshing': { en: 'Gyalshing', hi: 'ग्यालशिंग' },
    'Mangan': { en: 'Mangan', hi: 'मंगन' },
    // Tamil Nadu
    'Chennai': { en: 'Chennai', hi: 'चेन्नई' },
    'Coimbatore': { en: 'Coimbatore', hi: 'कोयंबटूर' },
    'Madurai': { en: 'Madurai', hi: 'मदुरै' },
    'Tiruchirappalli': { en: 'Tiruchirappalli', hi: 'तिरुचिरापल्ली' },
    'Salem': { en: 'Salem', hi: 'सेलम' },
    'Tirunelveli': { en: 'Tirunelveli', hi: 'तिरुनेलवेली' },
    'Tiruppur': { en: 'Tiruppur', hi: 'तिरुपुर' },
    'Erode': { en: 'Erode', hi: 'इरोड' },
    'Vellore': { en: 'Vellore', hi: 'वेल्लोर' },
    'Thoothukudi': { en: 'Thoothukudi', hi: 'तूத்துக்குडी' },
    'Dindigul': { en: 'Dindigul', hi: 'डिंडीगुल' },
    'Thanjavur': { en: 'Thanjavur', hi: 'तंजावुर' },
    'Hosur': { en: 'Hosur', hi: 'होसुर' },
    'Kanchipuram': { en: 'Kanchipuram', hi: 'कांचीपुरम' },
    'Kanyakumari': { en: 'Kanyakumari', hi: 'कन्याकुमारी' },
    'Nagercoil': { en: 'Nagercoil', hi: 'नागरकोविल' },
    'Ooty': { en: 'Ooty', hi: 'ऊटी' },
    'Pollachi': { en: 'Pollachi', hi: 'पोल्लाची' },
    'Rameswaram': { en: 'Rameswaram', hi: 'रामेश्वरम' },
    // Telangana
    'Hyderabad': { en: 'Hyderabad', hi: 'हैदराबाद' },
    'Warangal': { en: 'Warangal', hi: 'वारंगल' },
    'Nizamabad': { en: 'Nizamabad', hi: 'निजामाबाद' },
    'Karimnagar': { en: 'Karimnagar', hi: 'करीमनगर' },
    'Khammam': { en: 'Khammam', hi: 'खम्मम' },
    'Ramagundam': { en: 'Ramagundam', hi: 'रामागुंडम' },
    'Mahbubnagar': { en: 'Mahbubnagar', hi: 'महबूबनगर' },
    'Adilabad': { en: 'Adilabad', hi: 'आदिलाबाद' },
    'Siddipet': { en: 'Siddipet', hi: 'सिद्दीपेट' },
    'Suryapet': { en: 'Suryapet', hi: 'सूर्यापेट' },
    // Tripura
    'Agartala': { en: 'Agartala', hi: 'अगरतला' },
    'Udaipur': { en: 'Udaipur', hi: 'उदयपुर' },
    'Dharmanagar': { en: 'Dharmanagar', hi: 'धर्मनगर' },
    'Kailasahar': { en: 'Kailasahar', hi: 'कैलाशहर' },
    // Uttar Pradesh
    'Lucknow': { en: 'Lucknow', hi: 'लखनऊ' },
    'Kanpur': { en: 'Kanpur', hi: 'कानपुर' },
    'Ghaziabad': { en: 'Ghaziabad', hi: 'गाज़ियाबाद' },
    'Agra': { en: 'Agra', hi: 'आगरा' },
    'Varanasi': { en: 'Varanasi', hi: 'वाराणसी' },
    'Meerut': { en: 'Meerut', hi: 'मेरठ' },
    'Prayagraj': { en: 'Prayagraj', hi: 'प्रयागराज' },
    'Noida': { en: 'Noida', hi: 'नोएडा' },
    'Bareilly': { en: 'Bareilly', hi: 'बरेली' },
    'Aligarh': { en: 'Aligarh', hi: 'अलीगढ़' },
    'Gorakhpur': { en: 'Gorakhpur', hi: 'गोरखपुर' },
    'Saharanpur': { en: 'Saharanpur', hi: 'सहारनपुर' },
    'Jhansi': { en: 'Jhansi', hi: 'झांसी' },
    'Moradabad': { en: 'Moradabad', hi: 'मुरादाबाद' },
    'Mathura': { en: 'Mathura', hi: 'मथुरा' },
    'Ayodhya': { en: 'Ayodhya', hi: 'अयोध्या' },
    'Firozabad': { en: 'Firozabad', hi: 'फिरोजाबाद' },
    'Muzaffarnagar': { en: 'Muzaffarnagar', hi: 'मुजफ्फरनगर' },
    'Rampur': { en: 'Rampur', hi: 'रामपुर' },
    'Shahjahanpur': { en: 'Shahjahanpur', hi: 'शाहजहांपुर' },
    'Farrukhabad': { en: 'Farrukhabad', hi: 'फर्रुखाबाद' },
    'Hapur': { en: 'Hapur', hi: 'हापुड़' },
    'Etawah': { en: 'Etawah', hi: 'इटावा' },
    'Mirzapur': { en: 'Mirzapur', hi: 'मिर्जापुर' },
    'Bulandshahr': { en: 'Bulandshahr', hi: 'बुलंदशहर' },
    'Sambhal': { en: 'Sambhal', hi: 'संभल' },
    'Amroha': { en: 'Amroha', hi: 'अमरोहा' },
    'Hardoi': { en: 'Hardoi', hi: 'हरदोई' },
    'Fatehpur': { en: 'Fatehpur', hi: 'फतेहपुर' },
    'Raebareli': { en: 'Raebareli', hi: 'रायबरेली' },
    'Orai': { en: 'Orai', hi: 'उरई' },
    'Sitapur': { en: 'Sitapur', hi: 'सीतापुर' },
    'Bahraich': { en: 'Bahraich', hi: 'बहराइच' },
    'Unnao': { en: 'Unnao', hi: 'उन्नाव' },
    'Jaunpur': { en: 'Jaunpur', hi: 'जौनपुर' },
    'Lakhimpur': { en: 'Lakhimpur', hi: 'लखीमपुर' },
    'Hathras': { en: 'Hathras', hi: 'हाथरस' },
    'Banda': { en: 'Banda', hi: 'बांदा' },
    'Pilibhit': { en: 'Pilibhit', hi: 'पीलीभीत' },
    'Budaun': { en: 'Budaun', hi: 'बदायूं' },
    'Mughalsarai': { en: 'Mughalsarai', hi: 'मुगलसराय' },
    'Gonda': { en: 'Gonda', hi: 'गोंडा' },
    'Mainpuri': { en: 'Mainpuri', hi: 'मैनपुरी' },
    'Lalitpur': { en: 'Lalitpur', hi: 'ललितपुर' },
    // Uttarakhand
    'Dehradun': { en: 'Dehradun', hi: 'देहरादून' },
    'Haridwar': { en: 'Haridwar', hi: 'हरिद्वार' },
    'Roorkee': { en: 'Roorkee', hi: 'रुड़की' },
    'Haldwani': { en: 'Haldwani', hi: 'हल्द्वानी' },
    'Nainital': { en: 'Nainital', hi: 'नैनीताल' },
    'Rishikesh': { en: 'Rishikesh', hi: 'ऋषिकेश' },
    'Kashipur': { en: 'Kashipur', hi: 'काशीपुर' },
    'Rudrapur': { en: 'Rudrapur', hi: 'रुद्रपुर' },
    'Pithoragarh': { en: 'Pithoragarh', hi: 'पिथौरागढ़' },
    'Almora': { en: 'Almora', hi: 'अल्मोड़ा' },
    // West Bengal
    'Kolkata': { en: 'Kolkata', hi: 'कोलकाता' },
    'Asansol': { en: 'Asansol', hi: 'आसनसोल' },
    'Siliguri': { en: 'Siliguri', hi: 'सिलीगुड़ी' },
    'Durgapur': { en: 'Durgapur', hi: 'दुर्गापुर' },
    'Howrah': { en: 'Howrah', hi: 'हावड़ा' },
    'Darjeeling': { en: 'Darjeeling', hi: 'दार्जिलिंग' },
    'Kharagpur': { en: 'Kharagpur', hi: 'खड़गपुर' },
    'Haldia': { en: 'Haldia', hi: 'हल्दिया' },
    'Bardhaman': { en: 'Bardhaman', hi: 'बर्दवान' },
    'Malda': { en: 'Malda', hi: 'मालदा' },
    'Baharampur': { en: 'Baharampur', hi: 'बहरामपुर' },
    'Shantipur': { en: 'Shantipur', hi: 'शांतिपुर' },
    'Krishnanagar': { en: 'Krishnanagar', hi: 'कृष्णानगर' },
    'Cooch Behar': { en: 'Cooch Behar', hi: 'कूचबिहार' },
    'Jalpaiguri': { en: 'Jalpaiguri', hi: 'जलपाईगुड़ी' },
    'Bankura': { en: 'Bankura', hi: 'बांकुड़ा' },
    'Purulia': { en: 'Purulia', hi: 'पुरुलिया' }
};


    // --- TRANSLATION CONTENT ---
    const translations = {
        en: { formTitle: "Distributor, Dealer, Technician Inquiry", selectLangLabel: "Select Language", regtype: "Registration Type", regtype1: "Distributor", regtype2: "Dealer", regtype3: "Technician", personalInfoTitle: "Personal Information", mobileLabel: "Mobile Number", mobilePlaceholder: "9876543210", sendOtpBtn: "Send OTP", mobileInvalidFeedback: "Please enter a valid 10-digit mobile number.", otpLabel: "Enter OTP", otpPlaceholder: "6-digit OTP", otpInvalidFeedback: "Please enter the 6-digit OTP.", firstNameLabel: "Name", firstNameInvalidFeedback: "Name is required.", lastNameLabel: "Last Name", lastNameInvalidFeedback: "Last name is required.", dobLabel: "Date of Birth (Optional)", emailLabel: "Email ID (Optional)", emailPlaceholder: "you@example.com", emailInvalidFeedback: "Please enter a valid email address.", addressInfoTitle: "Address Information", stateLabel: "State", stateDefaultOption: "Choose...", stateInvalidFeedback: "Please select a state.", cityLabel: "City", cityDefaultOption: "Select a state first...", cityInvalidFeedback: "Please select a city.", addressLabel: "Complete Address", addressPlaceholder: "1234 Main St, Apartment, studio, or floor", addressInvalidFeedback: "Please enter your address.", photoTitle: "Profile Photo", photoSubtitle: "Capture a live photo using your device camera.", takePhotoButton: "Take Photo", photoInvalidFeedback: "A profile photo is required.", submitButton: "Submit", modalTitle: "Live Camera", modalCaptureBtn: "Capture", modalCloseBtn: "Close", modalSaveBtn: "Save Photo" },
        hi: { formTitle: "वितरक, डीलर, टेकनीशियन", selectLangLabel: "भाषा चुनें",  regtype: "पंजीकरण प्रकार", regtype1: "वितरक", regtype2: "डीलर", regtype3: "टेकनीशियन", personalInfoTitle: "व्यक्तिगत जानकारी", mobileLabel: "मोबाइल नंबर", mobilePlaceholder: "9876543210", sendOtpBtn: "ओटीपी भेजें", mobileInvalidFeedback: "कृपया एक मान्य 10-अंकीय मोबाइल नंबर दर्ज करें।", otpLabel: "ओटीपी दर्ज करें", otpPlaceholder: "6-अंकीय ओटीपी", otpInvalidFeedback: "कृपया 6-अंकीय ओटीपी दर्ज करें।", firstNameLabel: "नाम", firstNameInvalidFeedback: "नाम आवश्यक है।", lastNameLabel: "अंतिम नाम", lastNameInvalidFeedback: "अंतिम नाम आवश्यक है।", dobLabel: "जन्म तिथि (वैकल्पिक)", emailLabel: "ईमेल आईडी (वैकल्पिक)", emailPlaceholder: "you@example.com", emailInvalidFeedback: "कृपया एक मान्य ईमेल पता दर्ज करें।", addressInfoTitle: "पते की जानकारी", stateLabel: "राज्य", stateDefaultOption: "चुनें...", stateInvalidFeedback: "कृपया एक राज्य चुनें।", cityLabel: "शहर", cityDefaultOption: "पहले एक राज्य चुनें...", cityInvalidFeedback: "कृपया एक शहर चुनें।", addressLabel: "पूरा पता", addressPlaceholder: "1234 मेन सेंट, अपार्टमेंट, स्टूडियो, या मंजिल", addressInvalidFeedback: "कृपया अपना पता दर्ज करें।", photoTitle: "प्रोफ़ाइल फ़ोटो", photoSubtitle: "अपने डिवाइस कैमरे का उपयोग करके एक लाइव फोटो कैप्चर करें।", takePhotoButton: "फोटो लें", photoInvalidFeedback: "एक प्रोफ़ाइल फ़ोटो आवश्यक है।", submitButton: "जमा करना", modalTitle: "लाइव कैमरा", modalCaptureBtn: "कैप्चर", modalCloseBtn: "बंद करें", modalSaveBtn: "फोटो सहेजें" }
    };

    // --- DOM ELEMENTS ---
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');
    const form = document.getElementById('registrationForm');

    // --- HELPER FUNCTIONS ---
    const populateStates = (lang) => {
        const selectedValue = stateSelect.value;
        stateSelect.innerHTML = '';
        
        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.textContent = translations[lang].stateDefaultOption;
        defaultOption.disabled = true;
        defaultOption.selected = true;
        stateSelect.appendChild(defaultOption);

        statesData.forEach(state => {
            const option = document.createElement('option');
            option.value = state.value;
            option.textContent = state[lang];
            stateSelect.appendChild(option);
        });

        stateSelect.value = selectedValue;
    };

    const updateCities = () => {
        const lang = document.querySelector('input[name="language"]:checked').value;
        const selectedState = stateSelect.value;
        const cities = citiesByState[selectedState] || [];
        
        citySelect.innerHTML = '';

        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.textContent = selectedState ? translations[lang].stateDefaultOption : translations[lang].cityDefaultOption;
        defaultOption.disabled = true;
        defaultOption.selected = true;
        citySelect.appendChild(defaultOption);
        
        cities.forEach(cityValue => {
            const option = document.createElement('option');
            option.value = cityValue;
            option.textContent = cityTranslations[cityValue][lang];
            citySelect.appendChild(option);
        });
        
        citySelect.disabled = !selectedState;
    };

    const switchLanguage = (lang) => {
        // Switch static text
        document.querySelectorAll('[data-key]').forEach(el => {
            const key = el.getAttribute('data-key');
            if (translations[lang][key]) el.textContent = translations[lang][key];
        });
        document.querySelectorAll('[data-key-placeholder]').forEach(el => {
            const key = el.getAttribute('data-key-placeholder');
            if (translations[lang][key]) el.placeholder = translations[lang][key];
        });

        // Repopulate dynamic dropdowns
        populateStates(lang);
        updateCities(); // Directly update cities after states are updated
    };

    // --- EVENT LISTENERS ---
    document.querySelectorAll('input[name="language"]').forEach(radio => {
        radio.addEventListener('change', (event) => switchLanguage(event.target.value));
    });

    stateSelect.addEventListener('change', updateCities);

    form.addEventListener('submit', function (event) {
        const photoFeedback = document.getElementById('photo-feedback');
        if (!document.getElementById('photoData').value) {
            photoFeedback.style.display = 'block';
            event.preventDefault();
            event.stopPropagation();
        } else {
            photoFeedback.style.display = 'none';
        }
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);

    // --- INITIAL PAGE SETUP ---
    switchLanguage('en'); // Set initial language and populate fields

    // --- CAMERA FUNCTIONALITY (UNCHANGED) ---
    const cameraModal = document.getElementById('cameraModal'), video = document.getElementById('video-preview'), canvas = document.getElementById('photo-canvas'), captureBtn = document.getElementById('captureBtn'), savePhotoBtn = document.getElementById('savePhotoBtn'), photoDataInput = document.getElementById('photoData'), photoPreview = document.getElementById('photo-preview');
    let stream;
    cameraModal.addEventListener('show.bs.modal', async () => { try { stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false }); video.srcObject = stream; video.style.display = 'block'; canvas.style.display = 'none'; savePhotoBtn.disabled = true; } catch (err) { console.error("Error accessing camera: ", err); alert("Could not access the camera. Please ensure you have given permission."); } });
    cameraModal.addEventListener('hide.bs.modal', () => { if (stream) { stream.getTracks().forEach(track => track.stop()); } });
    captureBtn.addEventListener('click', () => { const context = canvas.getContext('2d'); canvas.width = video.videoWidth; canvas.height = video.videoHeight; context.drawImage(video, 0, 0, canvas.width, canvas.height); video.style.display = 'none'; canvas.style.display = 'block'; savePhotoBtn.disabled = false; });
    savePhotoBtn.addEventListener('click', () => { const imageDataUrl = canvas.toDataURL('image/jpeg'); photoDataInput.value = imageDataUrl; photoPreview.src = imageDataUrl; photoPreview.style.display = 'block'; document.getElementById('photo-feedback').style.display = 'none'; });
});
</script>

</body>
</html>