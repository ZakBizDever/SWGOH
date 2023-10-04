import './App.css';
import { ChakraProvider } from '@chakra-ui/react';
import { BrowserRouter } from 'react-router-dom';
import Main from './Main';

function App() {
  return ( <ChakraProvider>
        <Main />
    </ChakraProvider> );
}

export default App;
