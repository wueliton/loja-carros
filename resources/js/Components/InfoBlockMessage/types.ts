import { ReactNode } from 'react';
import { VariantProps } from 'tailwind-variants';
import { infoBlockMessageStlyes } from './styles';

type InfoBlockMessageVariants = VariantProps<typeof infoBlockMessageStlyes>;

export interface InfoBlockMessageProps {
  variant?: InfoBlockMessageVariants['color'];
  children: ReactNode;
}
