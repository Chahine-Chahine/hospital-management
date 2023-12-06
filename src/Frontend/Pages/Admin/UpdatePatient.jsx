import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function UpdatePatient() {
  const [patientID, setPatientID] = useState("");
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [address, setAddress] = useState("");
  const [updateStatus, setUpdateStatus] = useState(null);

  const handleUpdate = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Patients/update",
        method: "POST",
        body: {
          PatientID: patientID,
          Username: username,
          Email: email,
          Address: address,
        },
      });

      console.log(response);

      if (response.status === "Success") {
        setUpdateStatus("Patient updated successfully");
      } else {
        setUpdateStatus("Failed to update patient. Status: " + response.status);
      }
    } catch (error) {
      console.error("Error updating patient:", error.message);
    }
  };

  return (
    <div>
      <h2>Update Patient</h2>
      <form onSubmit={handleUpdate}>
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
          Username:
          <input
            type="text"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Email:
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </label>
        <br />
        <label>
          Address:
          <input
            type="text"
            value={address}
            onChange={(e) => setAddress(e.target.value)}
            required
          />
        </label>
       
        <br />
        <button type="submit">Update Patient</button>
      </form>

      {updateStatus && <p>{updateStatus}</p>}
    </div>
  );
}

export default UpdatePatient;
