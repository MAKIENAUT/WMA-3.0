const passportContainer = document.getElementById('pfp_field');
const passportInput = passportContainer.querySelector('.file_input_field');
const passportFileNameDisplay = passportContainer.querySelector('.file_name');

passportContainer.addEventListener('dragover', (e) => {
  e.preventDefault();
  passportContainer.style.border = '2px solid #333';
});

passportContainer.addEventListener('dragleave', () => {
  passportContainer.style.border = '2px dashed #ccc';
});

passportContainer.addEventListener('drop', (e) => {
  e.preventDefault();
  passportContainer.style.border = '2px dashed #ccc';

  const files = e.dataTransfer.files;
  passportInput.files = files;
  passportFileNameDisplay.textContent = files[0].name;
  passportContainer.classList.add('uploaded');
});

passportInput.addEventListener('change', () => {
  passportFileNameDisplay.textContent = passportInput.files[0].name;
  passportContainer.classList.add('uploaded');
});
