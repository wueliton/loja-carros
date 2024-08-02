import 'react-tooltip/dist/react-tooltip.css';
import '../css/app.scss';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import moment from 'moment';
import 'moment/dist/locale/pt-br';
import { createRoot, hydrateRoot } from 'react-dom/client';
import { DialogProvider } from './Context/Dialog';

moment.locale('pt-br');

const appName = import.meta.env.VITE_APP_NAME || 'Auto Shopping Raposo';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.tsx`,
      import.meta.glob('./Pages/**/*.tsx'),
    ),
  setup({ el, App, props }) {
    if (import.meta.env.DEV) {
      createRoot(el).render(
        <DialogProvider>
          <App {...props} />
        </DialogProvider>,
      );
      return;
    }

    hydrateRoot(
      el,
      <DialogProvider>
        <App {...props} />
      </DialogProvider>,
    );
  },
  progress: {
    color: '#4B5563',
  },
});
