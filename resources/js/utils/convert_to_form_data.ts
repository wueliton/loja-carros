export const convertToFormData = (
  obj: object,
  formData: { [k in string]: string | number } = {},
  parentKey = '',
) => {
  Object.entries(obj).forEach(([key, value]) => {
    const formKey = parentKey ? `${parentKey}[${key}]` : key;

    if (Array.isArray(value)) {
      value
        .filter(
          (arr) =>
            arr.value !== null && arr.value !== undefined && arr.value !== '',
        )
        .forEach((item, index) =>
          convertToFormData({ [index]: item }, formData, formKey),
        );
    } else if (typeof value === 'object' && value !== null) {
      convertToFormData(value, formData, formKey);
    } else {
      formData[formKey] = value;
    }
  });

  return formData;
};
