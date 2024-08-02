import { ImgHTMLAttributes } from 'react';
import raposoLogo from '../../img/logo.jpeg';

export default function ApplicationLogo(
  props: ImgHTMLAttributes<HTMLImageElement>,
) {
  return <img {...props} src={raposoLogo} />;
}
