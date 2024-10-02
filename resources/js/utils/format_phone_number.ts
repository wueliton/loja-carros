export const formatPhoneNumber = (phone: string | number) => {
  const regex = /^\(?(\d{2})\)?[-\s]?(\d{4,5})[-\s]?(\d{4})$/;
  return String(phone).replace(regex, '($1) $2-$3');
};
