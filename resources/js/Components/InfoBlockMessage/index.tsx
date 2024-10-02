import { ExclamationCircleIcon } from '../Icons/ExclamationCircle';
import { infoBlockMessageStlyes } from './styles';
import { InfoBlockMessageProps } from './types';

export const InfoBlockMessage = ({
  variant,
  children,
}: InfoBlockMessageProps) => {
  const { container, icon } = infoBlockMessageStlyes();

  return (
    <div className={container({ color: variant })}>
      <div className={icon({ color: variant })}>
        <ExclamationCircleIcon />
      </div>
      <div>{children}</div>
    </div>
  );
};
