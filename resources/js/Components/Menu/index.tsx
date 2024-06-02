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

export interface MenuProps extends PropsWithChildren {
  parent: MutableRefObject<HTMLElement | null>;
  opened: boolean;
  onClose: () => void;
}

export const FloatingMenu: FC<MenuProps> = memo(
  ({ children, parent, opened, onClose }) => {
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

    useEffect(() => {
      if (opened) adjustPosition();
    }, [opened]);

    useEffect(() => {
      window.addEventListener('scroll', adjustPosition);
      document.addEventListener('click', clickedOutside);

      return () => {
        document.removeEventListener('click', clickedOutside);
        window.removeEventListener('scroll', adjustPosition);
      };
    }, []);

    return (
      <div
        ref={menuRef}
        style={{ top: `${top}px` }}
        className={`${styles.list} ${opened ? styles.opened : ''}`}
      >
        {children}
      </div>
    );
  },
);
