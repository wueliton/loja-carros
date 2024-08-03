import 'react-tooltip/dist/react-tooltip.css';
import '../css/app.scss';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import moment from 'moment';
import 'moment/dist/locale/pt-br';
import { ReactElement } from 'react';
import { createRoot, hydrateRoot } from 'react-dom/client';
import { DialogProvider } from './Context/Dialog';
import { AuthenticatedLayout } from './Layouts/Authenticated';

moment.locale('pt-br');

const appName = import.meta.env.VITE_APP_NAME || 'Auto Shopping Raposo';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: async (name) => {
    const page = (await resolvePageComponent(
      `./Pages/${name}.tsx`,
      import.meta.glob('./Pages/**/*.tsx'),
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
    )) as any;
    page.default.layout =
      page.default.layout ||
      ((page: ReactElement) => (
        <AuthenticatedLayout user={page.props.auth.user}>
          <DialogProvider>{page}</DialogProvider>
        </AuthenticatedLayout>
      ));
    return page;
  },
  setup({ el, App, props }) {
    if (import.meta.env.DEV) {
      createRoot(el).render(
        <DialogProvider>
          <App {...props} />
        </DialogProvider>,
      );
      return;
    }

    hydrateRoot(el, <App {...props} />);
  },
  progress: {
    color: '#4B5563',
  },
});
