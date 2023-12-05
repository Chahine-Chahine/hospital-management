import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function DeleteDoctor() {
  const [doctorID, setDoctorID] = useState("");
  const [deleteStatus, setDeleteStatus] = useState(null);

  const handleDelete = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Doctors/delete",
        method: "POST",
        body: {
          DoctorID: doctorID,
        },
      });

      console.log(response);

      if (response.status === "Deleted") {
        setDeleteStatus("Doctor deleted successfully");
      } else {
        setDeleteStatus("Doctor not found or already deleted");
      }
    } catch (error) {
      console.error("Error deleting doctor:", error.message);
    }
  };

  return (
    <div>
      <h2>Delete Doctor</h2>
      <form onSubmit={handleDelete}>
        <label>
          Doctor ID:
          <input
            type="number"
            value={doctorID}
            onChange={(e) => setDoctorID(e.target.value)}
          />
        </label>
        <br />
        <button type="submit">Delete Doctor</button>
      </form>

      {deleteStatus && <p>{deleteStatus}</p>}
    </div>
  );
}

export default DeleteDoctor;
