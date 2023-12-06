import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function ReadPatient() {
  const [patientID, setPatientID] = useState("");
  const [patientInfo, setPatientInfo] = useState(null);

  const handleRead = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Patients/read",
        method: "POST",
        body: {
          PatientID: patientID,
        },
      });

      console.log(response);

      if (response.status === "Success") {
        setPatientInfo(response);
      } else {
        setPatientInfo(null);
        console.log("Failed to fetch patient. Status:", response.status);
      }
    } catch (error) {
      console.error("Error fetching patient:", error.message);
    }
  };

  return (
    <div>
      <h2>Read Patient</h2>
      <form onSubmit={handleRead}>
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
        <button type="submit">Read Patient</button>
      </form>

      {patientInfo && (
        <div>
          <h3>Patient Information:</h3>
          <p>User ID: {patientInfo.user_id}</p>
          <p>Username: {patientInfo.Username}</p>
          <p>Email: {patientInfo.Email}</p>
          <p>Address: {patientInfo.Address}</p>
        </div>
      )}
    </div>
  );
}

export default ReadPatient;
