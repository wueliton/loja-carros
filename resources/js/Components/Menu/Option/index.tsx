import {
  ComponentPropsWithoutRef,
  ElementType,
  PropsWithChildren,
} from 'react';

type ElementAsWithProps<E extends ElementType> = {
  as?: E;
};

type MenuOptionProps<E extends ElementType> = PropsWithChildren<
  ComponentPropsWithoutRef<E> & ElementAsWithProps<E>
>;

export const MenuOption = <T extends ElementType>({
  children,
  className,
  as,
  ...props
}: MenuOptionProps<T>) => {
  const Element = as ?? 'div';

  return (
    <Element {...props} className={`${className ?? ''}`}>
      {children}
    </Element>
  );
};
