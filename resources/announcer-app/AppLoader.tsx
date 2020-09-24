import * as React from 'react';
import App from "./App";
import TestApp from "./TestApp";

interface IProps {
    testMode?: string;
}

const AppLoader = (props:IProps) => {
  const
      {testMode} = props;

  if (testMode == "demo") {
      return <TestApp/>
  } else {
      //боевое приложение ещё не готово
      return <App/>;
  }
};

export default AppLoader;
