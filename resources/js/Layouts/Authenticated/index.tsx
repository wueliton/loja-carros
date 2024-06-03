import { IconButton } from '@/Components/IconButton';
import { MenuIcon } from '@/Components/Icons/Menu';
import { NavComponent } from '@/Components/Nav';
import { User } from '@/types';
import {
  FC,
  PropsWithChildren,
  ReactElement,
  useEffect,
  useRef,
  useState,
} from 'react';
import styles from './Authenticated.module.scss';

export const AuthenticatedLayout: FC<
  PropsWithChildren & { user: User; head?: ReactElement }
> = ({ children, head }) => {
  const [navOpened, setNavOpened] = useState(false);
  const navRef = useRef<HTMLElement>(null);
  const avatarRef = useRef<HTMLButtonElement>(null);

  function clickedOutside(e: MouseEvent) {
    if (
      !navRef.current ||
      (navRef.current && navRef.current.contains(e.target as HTMLElement)) ||
      !Array.from(navRef.current.classList).some((elClass) => {
        return elClass.startsWith('_opened');
      })
    )
      return;
    setNavOpened((prev) => {
      if (prev) return false;
      return prev;
    });
  }

  const handleOpenMenu = (
    e: React.MouseEvent<HTMLButtonElement, MouseEvent>,
  ) => {
    e.stopPropagation();
    setNavOpened(true);
  };

  useEffect(() => {
    document.addEventListener('click', clickedOutside);

    return () => document.removeEventListener('click', clickedOutside);
  }, []);

  return (
    <div className={styles.layout}>
      <NavComponent ref={navRef} opened={navOpened} />
      <main>
        <div className={styles.head}>
          <div className={styles.content}>{head}</div>
          <div className={styles.profile}>
            <button className={styles.avatar}>P</button>
            {/* <FloatingMenu
              className="w-52"
              opened={true}
              parent={avatarRef}
              onClose={() => {}}
            >
              <>Item</>
            </FloatingMenu> */}
            <IconButton
              onClick={handleOpenMenu}
              icon={<MenuIcon />}
              className="md:hidden"
            ></IconButton>
          </div>
        </div>
        <div className={styles.content}>{children}</div>
      </main>
    </div>
  );
};
