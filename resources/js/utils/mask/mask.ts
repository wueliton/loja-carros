class Mask {
  static number(value: string | number) {
    return Number(String(value).replace(/\D/g, ''));
  }

  static currency(
    value: string | number,
    prevValue: string | number,
    max?: number | string,
  ) {
    let onlyNumbers = this.number(value) / 100;

    if (max && typeof max === 'number') {
      if (onlyNumbers > max) {
        onlyNumbers = this.number(prevValue) / 100;
      } else {
        onlyNumbers = Math.min(max, onlyNumbers);
      }
    }

    return Intl.NumberFormat('pt-BR', {
      style: 'decimal',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    }).format(onlyNumbers);
  }

  static brazilPhone(value: string | number) {
    if (!value) return;

    const onlyNumber = String(this.number(value));
    const phoneLength = onlyNumber.length;

    if (phoneLength <= 2) return onlyNumber;

    if (phoneLength <= 3) {
      return onlyNumber.replace(/(\d{2})/, '($1) ');
    }
    if (phoneLength <= 6) {
      return onlyNumber.replace(/^(\d{2}?)(\d{0,4})/, '($1) $2');
    }
    if (phoneLength <= 10) {
      return onlyNumber.replace(
        /^(\d{2}?)(\d{0,4})(\d{0,4})(.*)/,
        '($1) $2-$3',
      );
    }

    return onlyNumber.replace(/^(\d{2}?)(\d{0,5})(\d{0,4})(.*)/, '($1) $2-$3');
  }
}

export { Mask };
