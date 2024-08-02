import { createInertiaApp } from '@inertiajs/react';
import createServer from '@inertiajs/react/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import ReactDOMServer from 'react-dom/server';
import { RouteName } from 'ziggy-js';
import { route } from '../../vendor/tightenco/ziggy';
import { DialogProvider } from './Context/Dialog';

const appName = import.meta.env.VITE_APP_NAME || 'Auto Shopping Raposo';

createServer((page) =>
  createInertiaApp({
    page,
    render: ReactDOMServer.renderToString,
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
      resolvePageComponent(
        `./Pages/${name}.tsx`,
        import.meta.glob('./Pages/**/*.tsx'),
      ),
    setup: ({ App, props }) => {
      global.route<RouteName> = (name, params, absolute) =>
        route(name, params as never, absolute, {
          // @ts-expect-error Ignora erros no objeto
          ...page.props.ziggy,
          // @ts-expect-error ignora erros no objeto
          location: new URL(page.props.ziggy.location),
        });

      return (
        <DialogProvider>
          <App {...props} />
        </DialogProvider>
      );
    },
  }),
);
