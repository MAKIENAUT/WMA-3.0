const resumeContainer = document.getElementById('resume_container');
const resumeInput = resumeContainer.querySelector('.file_input_field');
const resumeFileNameDisplay = resumeContainer.querySelector('.file_name');

const passportContainer = document.getElementById('passport_container');
const passportInput = passportContainer.querySelector('.file_input_field');
const passportFileNameDisplay = passportContainer.querySelector('.file_name');

resumeContainer.addEventListener('dragover', (e) => {
  e.preventDefault();
  resumeContainer.style.border = '2px solid #333';
});

resumeContainer.addEventListener('dragleave', () => {
  resumeContainer.style.border = '2px dashed #ccc';
});

resumeContainer.addEventListener('drop', (e) => {
  e.preventDefault();
  resumeContainer.style.border = '2px dashed #ccc';

  const files = e.dataTransfer.files;
  resumeInput.files = files;
  resumeFileNameDisplay.textContent = files[0].name;
  resumeContainer.classList.add('uploaded');
});

resumeInput.addEventListener('change', () => {
  resumeFileNameDisplay.textContent = resumeInput.files[0].name;
  resumeContainer.classList.add('uploaded');
});

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
