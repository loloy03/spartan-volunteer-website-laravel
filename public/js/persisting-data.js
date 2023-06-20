const inputs = document.querySelectorAll('.input');
const inputFile = document.querySelector('#file');

// persisting <input type="text"> and <textarea>
inputs.forEach(input => {
  input.addEventListener('input', () => {
    sessionStorage.setItem(input.id, input.value);
  });

  input.addEventListener('change', () => {
    sessionStorage.setItem(input.id, input.value);
  });

  let savedValue = sessionStorage.getItem(input.id);
  if (savedValue) {
    input.value = savedValue;
  }
});

// persisting image input
