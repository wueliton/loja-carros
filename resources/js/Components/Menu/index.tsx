import {
  MenuButton,
  Menu as MenuHeadless,
  MenuItems,
  MenuItemsProps,
} from '@headlessui/react';
import { FC, ReactElement } from 'react';
import styles from './Menu.module.scss';

interface MenuProps {
  anchor?: MenuItemsProps['anchor'];
  target: ReactElement;
  options?: ReactElement | boolean;
}

export const Menu: FC<MenuProps> = ({ anchor = 'bottom', target, options }) => {
  return (
    <MenuHeadless>
      <MenuButton onClick={(e) => !options && e.preventDefault()}>
        {target}
      </MenuButton>
      <MenuItems transition className={styles.menu} anchor={anchor}>
        {options}
      </MenuItems>
    </MenuHeadless>
  );
};
