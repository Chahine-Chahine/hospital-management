import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function DeletePatient() {
  const [patientID, setPatientID] = useState("");
  const [deleteStatus, setDeleteStatus] = useState(null);

  const handleDelete = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Patients/delete",
        method: "POST",
        body: {
          PatientID: patientID,
        },
      });

      console.log(response);

      if (response.status === "Deleted") {
        setDeleteStatus("Patient deleted successfully");
      } else {
        setDeleteStatus("Patient not found or already deleted");
      }
    } catch (error) {
      console.error("Error deleting patient:", error.message);
    }
  };

  return (
    <div>
      <h2>Delete Patient</h2>
      <form onSubmit={handleDelete}>
        <label>
          Patient ID:
          <input
            type="number"
            value={patientID}
            onChange={(e) => setPatientID(e.target.value)}
          />
        </label>
        <br />
        <button type="submit">Delete Patient</button>
      </form>

      {deleteStatus && <p>{deleteStatus}</p>}
    </div>
  );
}

export default DeletePatient;
