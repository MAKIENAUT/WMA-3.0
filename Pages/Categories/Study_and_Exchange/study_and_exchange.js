function showfield(profession) {
	if (profession != 'Other') {
		document.getElementById('div1').style.display = "none";
		document.getElementById("other").value = "Other";

	} else {
		document.getElementById('div1').style.display = "block";
		document.getElementById("other").value = "";
		change()

	}
}

function change() {
	if (document.forms["myForm"]["other_option"].value == "") {
		document.getElementById("other").value = "";
		validate();
		document.getElementById("yes").disabled = true;

	} else {
		document.forms["myForm"]["other_option"].style.border = "none";
		document.forms["myForm"]["profession"].style.border = "none";
		document.getElementById("other").value = document.getElementById("other_option").value;
		validate();
	}
}

// Get the form element
const form = document.querySelector('form');
// Get the profession dropdown element
const professionDropdown = document.getElementById('profession');

// Function to validate form fields
function validateForm(event) {
	// Check if the 'Yes' radio button is selected
	const eligibilityRadio = document.getElementById('yes');
	// Check if the 'Terms and Conditions' checkbox is checked
	const termsCheckbox = document.getElementById('terms_and_condition');

	// Check if the default option is selected in the profession dropdown
	const selectedProfession = professionDropdown.value;

	// If 'Yes' radio button is not selected, 'Terms and Conditions' checkbox is not checked,
	// or default option is selected in the profession dropdown
	if (!eligibilityRadio.checked || !termsCheckbox.checked || selectedProfession === '') {
		// Prevent form submission
		event.preventDefault();
		// Provide a user alert indicating the validation failure
		alert('Please select a valid profession before submitting the form confirm eligibility, and accept terms and conditions.');
	}
}

// Add event listener for form submission
form.addEventListener('submit', validateForm);

