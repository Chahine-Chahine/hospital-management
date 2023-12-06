import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function CreatePatientRecord() {
  const [patientID, setPatientID] = useState("");
  const [doctorID, setDoctorID] = useState("");
  const [diagnosis, setDiagnosis] = useState("");
  const [treatment, setTreatment] = useState("");
  const [prescription, setPrescription] = useState("");
  const [recordDateTime, setRecordDateTime] = useState("");
  const [createStatus, setCreateStatus] = useState(null);

  const handleCreate = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "PatientRecord/create", 
        method: "POST",
        body: {
          PatientID: patientID,
          DoctorID: doctorID,
          Diagnosis: diagnosis,
          Treatment: treatment,
          Prescription: prescription,
          RecordDateTime: recordDateTime,
        },
      });

      if (response.status === "true") {
        setCreateStatus("Patient record created successfully");
      } else {
        setCreateStatus("Failed to create patient record");
      }
    } catch (error) {
      console.error("Error creating patient record:", error.message);
    }
  };

  return (
    <div>
      <h2>Create Patient Record</h2>
      <form onSubmit={handleCreate}>
        {/* Add input fields for patient record details */}
        <label>
          Patient ID:
          <input
            type="number"
            value={patientID}
            onChange={(e) => setPatientID(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Doctor ID:
          <input
            type="number"
            value={doctorID}
            onChange={(e) => setDoctorID(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Diagnosis:
          <input
            type="text"
            value={diagnosis}
            onChange={(e) => setDiagnosis(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Treatment:
          <input
            type="text"
            value={treatment}
            onChange={(e) => setTreatment(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Prescription:
          <input
            type="text"
            value={prescription}
            onChange={(e) => setPrescription(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Record Date Time:
          <input
            type="datetime-local"
            value={recordDateTime}
            onChange={(e) => setRecordDateTime(e.target.value)}
            required
          />
        </label>
        <br />
        <button type="submit">Create Patient Record</button>
      </form>

      {createStatus && <p>{createStatus}</p>}
    </div>
  );
}

export default CreatePatientRecord;
