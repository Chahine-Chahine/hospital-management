// App.js
import React from 'react';
import { Route, Routes, BrowserRouter } from 'react-router-dom';
import Form from '../../Common/Signin';
import AdminPage from '../Admin/AdminPage';
import DoctorPage from '../Doctor/DoctorPage';
import PatientPage from '../Patient/PatientPage';
import CreateDoctor from '../Admin/CreateDoctor';
import ReadDoctor from '../Admin/ReadDoctor';
import UpdateDoctor from '../Admin/UpdateDoctor';
import DeleteDoctor from '../Admin/DeleteDoctor';
import CreatePatient from '../Admin/CreatePatient';
import ReadPatient from '../Admin/ReadPatient';
import UpdatePatient from '../Admin/UpdatePatient';
import DeletePatient from '../Admin/DeletePatient';
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Form />} />
        <Route path="/admin" element={<AdminPage />} />
        <Route path="/admin/create-doctor" element={<CreateDoctor/>} />
        <Route path="/admin/read-doctor" element={<ReadDoctor/>} />
        <Route path="/admin/update-doctor" element={<UpdateDoctor/>} />
        <Route path="/admin/delete-doctor" element={<DeleteDoctor/>} />
        <Route path="/admin/create-patient" element={<CreatePatient/>} />
        <Route path="/admin/read-patient" element={<ReadPatient/>} />
        <Route path="/admin/update-patient" element={<UpdatePatient/>} />
        <Route path="/admin/delete-patient" element={<DeletePatient/>} />
        <Route path="/doctor" element={<DoctorPage />} />
        <Route path="/patient" element={<PatientPage />} />
      </Routes>
 
    </BrowserRouter>
  );
}

export default App;
