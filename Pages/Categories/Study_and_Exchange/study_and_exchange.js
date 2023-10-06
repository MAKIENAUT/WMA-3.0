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