import { IconButton } from '@/Components/IconButton';
import { MenuIcon } from '@/Components/Icons/Menu';
import { FloatingMenu } from '@/Components/Menu';
import { NavComponent } from '@/Components/Nav';
import { User } from '@/types';
import { Link } from '@inertiajs/react';
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
  PropsWithChildren & { user?: User; head?: ReactElement }
> = ({ children, head, user }) => {
  const [navOpened, setNavOpened] = useState(false);
  const [menuOpened, setMenuOpened] = useState(false);
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
            <button
              className={styles.avatar}
              onClick={(e) => {
                setMenuOpened((prev) => !prev);
                e.stopPropagation();
              }}
            >
              {user?.name.charAt(0)}
            </button>
            <FloatingMenu
              className={styles['floating-menu']}
              opened={menuOpened}
              parent={avatarRef}
              onClose={() => setMenuOpened(false)}
            >
              <Link href={route('profile.edit')} as="button">
                Meu Perfil
              </Link>
              <Link href={route('logout')} method="post" as="button">
                Sair
              </Link>
            </FloatingMenu>
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
