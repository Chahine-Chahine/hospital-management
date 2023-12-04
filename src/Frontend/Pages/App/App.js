// App.js
import React from 'react';
import { Route, Routes, BrowserRouter } from 'react-router-dom';
import Form from '../../Common/Form';
import AdminPage from '../Admin/AdminPage';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Form />} />
        <Route path="/admin" element={<AdminPage />} />
      </Routes>
 
    </BrowserRouter>
  );
}

export default App;
