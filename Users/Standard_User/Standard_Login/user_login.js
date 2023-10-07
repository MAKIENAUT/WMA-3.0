function togglePassword() {
   var x = document.getElementById("password");
   var eye = document.getElementById("eye");
   var eyeSlash = document.getElementById("eye-slash");

   if (x.type === "password") {
      x.type = "text";
      eye.style.display = "none";
      eyeSlash.style.display = "block";
   } else {
      x.type = "password";
      eye.style.display = "block";
      eyeSlash.style.display = "none";
   }
}
