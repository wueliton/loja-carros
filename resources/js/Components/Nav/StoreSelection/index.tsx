import { ArrowUpDown } from '@/Components/Icons/ArrowUpDown';
import { Menu } from '@/Components/Menu';
import { useUser } from '@/Context/User';
import { Store } from '@/models/Store';
import { MenuItem } from '@headlessui/react';
import { router } from '@inertiajs/react';
import { FC, useMemo } from 'react';
import styles from './StoreSelection.module.scss';

export const StoreSelection: FC = () => {
  const { stores, lastStore } = useUser();
  const hasMoreThanOneStore = useMemo(
    () => (stores ?? []).length > 1,
    [stores],
  );
  const activeStore = useMemo(
    () => stores?.find((store) => store.id === lastStore),
    [lastStore, stores],
  );
  const filteredStores = useMemo(
    () => stores?.filter((store) => store.id !== lastStore),
    [stores, lastStore],
  );

  return (
    <Menu
      target={
        <div className={styles.store}>
          {activeStore ? (
            <>
              <div className={styles.icon}>
                <img
                  src={`storage/uploads/${activeStore.logo_url}`}
                  title="Loja 2"
                />
              </div>
              <span>{activeStore.name}</span>
              {hasMoreThanOneStore ? <ArrowUpDown /> : <span></span>}
            </>
          ) : stores?.length ? (
            <>Selecione uma loja</>
          ) : (
            <>Nenhuma loja disponível</>
          )}
        </div>
      }
      options={
        !!filteredStores?.length && (
          <>
            {filteredStores?.map((store) => (
              <MenuItem key={store.id}>
                <button
                  onClick={() =>
                    router.post(
                      route(Store.GET_ROUTE('changeUserStore'), {
                        storeId: store.id,
                      }),
                    )
                  }
                >
                  {store.name}
                </button>
              </MenuItem>
            ))}
          </>
        )
      }
    ></Menu>
  );
};
