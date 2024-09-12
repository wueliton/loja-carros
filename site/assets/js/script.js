const toggles = document.querySelectorAll('.btn-toggle button');
toggles.forEach((toggle) => {
  toggle.addEventListener('click', () => {
    toggleValue(toggle);
  });
});

function toggleValue(toggle) {
  const input = toggle.closest('.btn-toggle').querySelector('input');
  input.value = toggle.value;

  if (document.querySelectorAll('.toggle_content').length) {
    document
      .querySelectorAll('.toggle_content')
      .forEach((el) => el.classList.remove('active'));
    document.querySelector(`#${toggle.value}_content`).classList.add('active');
  }

  const changeEvent = new Event('change', {
    bubbles: true,
    cancelable: true,
  });
  input.dispatchEvent(changeEvent);
  if (toggle.classList.contains('active')) return;
  toggles.forEach((toggle) => toggle.classList.remove('active'));
  toggle.classList.add('active');
}

function onSearchTypeChange() {
  const searchType = document.querySelector('#search_type').value;
  const brandModelField = document.querySelector('#brand_model');
  brandModelField.value = '';
  getBrandModels(searchType);
}

function onModelChange(
  brandField = '#brand',
  brandModelField = '#brand_model',
) {
  const searchType = document.querySelector('#search_type').value;
  const brandId = document.querySelector(brandField).value;
  const brandModelFieldEl = document.querySelector(brandModelField);
  brandModelFieldEl.disabled = brandId === '';
  brandModelFieldEl.value = '';
  getBrandModels(searchType, brandField, brandModelField);
}

function renderOptions(element, options, brandField = '#brand') {
  element.innerHTML = '';
  [
    {
      name: 'Selecione uma opção',
      id: '',
    },
    ...options,
  ].forEach((option) => {
    const optionEl = document.createElement('option');
    optionEl.textContent = option.name;
    optionEl.value = option.id;
    element.appendChild(optionEl);
  });
  if (document.querySelector(brandField).value) element.disabled = false;
}

function getBrandModels(
  type,
  brandField = '#brand',
  brandModelField = '#brand_model',
) {
  const brandModelsField = document.querySelector(brandModelField);
  const brandId = document.querySelector(brandField).value;
  brandModelsField.disabled = true;
  fetch(
    `http://localhost:8000/api/${type ?? 'cars'}/brand-models?where[and][0][fieldName]=brand_id&where[and][0][value]=${brandId}&where[and][0][comparison]=equals`,
  )
    .then((res) => res.json())
    .then((brandModels) =>
      renderOptions(brandModelsField, brandModels, brandField),
    );
}
