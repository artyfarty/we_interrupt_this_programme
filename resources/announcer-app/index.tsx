import * as React from 'react';
import * as ReactDOM from 'react-dom';
import AppLoader from './AppLoader';

const testMode:string = `${process.env.MIX_ANNOUNCER_APP_TEST_MODE}`;

ReactDOM.render(
  <React.StrictMode>
    <AppLoader testMode={testMode}/>
  </React.StrictMode>,
  document.getElementById('root')
);
