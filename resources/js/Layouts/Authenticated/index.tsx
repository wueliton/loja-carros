import { FloatingMenu } from '@/Components/FloatingMenu';
import { IconButton } from '@/Components/IconButton';
import { MenuIcon } from '@/Components/Icons/Menu';
import { NavComponent } from '@/Components/Nav';
import { UserProvider } from '@/Context/User';
import { User } from '@/types';
import { Link } from '@inertiajs/react';
import { FC, PropsWithChildren, useEffect, useRef, useState } from 'react';
import styles from './Authenticated.module.scss';

export const AuthenticatedLayout: FC<
  PropsWithChildren & { user?: User; roles?: string[] }
> = ({ children, user, roles }) => {
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
    <UserProvider user={user} roles={roles}>
      <div className={styles.layout} scroll-region="true">
        <NavComponent
          ref={navRef}
          opened={navOpened}
          setOpened={(opened: boolean) => setNavOpened(opened)}
        />
        <main scroll-region="true">
          <div className={styles.head}>
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
                <Link
                  href={route('profile.edit')}
                  onClick={() => setMenuOpened(false)}
                  as="button"
                >
                  Meu Perfil
                </Link>
                <Link
                  href={route('logout')}
                  onClick={() => setMenuOpened(false)}
                  method="post"
                  as="button"
                >
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
    </UserProvider>
  );
};
