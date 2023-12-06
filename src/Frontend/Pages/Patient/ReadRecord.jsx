import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function ReadPatientRecord() {
  const [recordID, setRecordID] = useState("");
  const [patientRecord, setPatientRecord] = useState(null);
  const [error, setError] = useState(null);

  const handleRead = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "PatientRecord/read", 
        method: "POST",
        body: {
          RecordID: recordID,
        },
      });

      if (response.status === "false") {
        setError(response.message);
      } else {
        setPatientRecord(response);
        setError(null);
      }
    } catch (error) {
      console.error("Error reading patient record:", error.message);
    }
  };

  return (
    <div>
      <h2>Read Patient Record</h2>
      <form onSubmit={handleRead}>
        <label>
          Record ID:
          <input
            type="number"
            value={recordID}
            onChange={(e) => setRecordID(e.target.value)}
          />
        </label>
        <br />
        <button type="submit">Read Patient Record</button>
      </form>

      {patientRecord && (
        <div>
          <h3>Patient Record</h3>
          <pre>{JSON.stringify(patientRecord, null, 2)}</pre>
        </div>
      )}

      {error && <p>{error}</p>}
    </div>
  );
}

export default ReadPatientRecord;
