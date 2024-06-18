import {
  FC,
  MutableRefObject,
  PropsWithChildren,
  memo,
  useEffect,
  useRef,
  useState,
} from 'react';
import styles from './Menu.module.scss';

export type AcceptedKeys = 'enter' | 'arrowup' | 'arrowdown';

export interface FloatingMenuProps extends PropsWithChildren {
  parent: MutableRefObject<HTMLElement | null>;
  opened: boolean;
  className?: string;
  onClose: () => void;
  onKeyPressed?: (key: AcceptedKeys) => void;
}

export const FloatingMenu: FC<FloatingMenuProps> = memo(
  ({ children, parent, opened, className, onClose, onKeyPressed }) => {
    const [top, setTop] = useState(
      (parent.current?.getBoundingClientRect().height ?? 82) - 8,
    );
    const menuRef = useRef<HTMLDivElement | null>(null);

    const adjustPosition = () => {
      if (!menuRef.current || !parent.current) return;
      let height = menuRef.current.getBoundingClientRect().height;
      const { top, height: inputHeight } =
        parent.current.getBoundingClientRect();

      if (!height) {
        height = 384;
      }

      if (top + inputHeight + height > window.innerHeight) {
        setTop(height * -1);
      } else {
        setTop(inputHeight - 8);
      }
    };

    function clickedOutside(e: MouseEvent) {
      if (
        (parent.current && parent.current.contains(e.target as HTMLElement)) ||
        (menuRef.current && menuRef.current.contains(e.target as HTMLElement))
      )
        return;
      onClose();
    }

    function keyboardOptionSelect(e: KeyboardEvent) {
      const acceptedKeys = ['arrowup', 'arrowdown', 'enter'];
      const isOpen = menuRef.current?.classList.contains(styles.opened);
      const pressedKey = e.key.toLowerCase();
      if (!acceptedKeys.includes(pressedKey) || !isOpen) return;
      e.preventDefault();
      onKeyPressed?.(pressedKey as AcceptedKeys);
    }

    useEffect(() => {
      if (opened) adjustPosition();
    }, [opened]);

    useEffect(() => {
      window.addEventListener('scroll', adjustPosition);
      document.addEventListener('click', clickedOutside);
      document.addEventListener('keydown', keyboardOptionSelect);

      return () => {
        document.removeEventListener('click', clickedOutside);
        window.removeEventListener('scroll', adjustPosition);
        document.removeEventListener('keydown', keyboardOptionSelect);
      };
    }, []);

    return (
      <div
        ref={menuRef}
        style={{ top: `${top}px` }}
        className={`${styles.list} ${opened ? styles.opened : ''} ${className ?? ''}`}
      >
        {children}
      </div>
    );
  },
);
