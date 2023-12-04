// App.js
import React from 'react';
import { Route, Routes, BrowserRouter } from 'react-router-dom';
import Form from '../../Common/Form';
import AdminPage from '../Admin/AdminPage';
import DoctorPage from '../Doctor/DoctorPage';
import PatientPage from '../Patient/PatientPage';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Form />} />
        <Route path="/admin" element={<AdminPage />} />
        <Route path="/doctor" element={<DoctorPage />} />
        <Route path="/patient" element={<PatientPage />} />
      </Routes>
 
    </BrowserRouter>
  );
}

export default App;
