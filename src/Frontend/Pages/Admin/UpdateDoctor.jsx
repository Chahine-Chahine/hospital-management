import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function UpdateDoctor() {
  const [doctorID, setDoctorID] = useState("");
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [address, setAddress] = useState("");
  const [specialization, setSpecialization] = useState("");
  const [updateStatus, setUpdateStatus] = useState(null);

  const handleUpdate = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Doctors/update",
        method: "POST",
        body: {
          DoctorID: doctorID,
          Username: username,
          Email: email,
          Address: address,
          Specialization: specialization,
        },
      });

      console.log(response);

      if (response.status === "Success") {
        setUpdateStatus("Doctor updated successfully");
      } else {
        setUpdateStatus("Doctor not found or no changes made");
      }
    } catch (error) {
      console.error("Error updating doctor:", error.message);
    }
  };

  return (
    <div>
      <h2>Update Doctor</h2>
      <form onSubmit={handleUpdate}>
        <label>
          Doctor ID:
          <input
            type="text"
            value={doctorID}
            onChange={(e) => setDoctorID(e.target.value)}
          />
        </label>
        <br />
        <label>
          Username:
          <input
            type="text"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
        </label>
        <br />
        <label>
          Email:
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
        </label>
        <br />
        <label>
          Address:
          <input
            type="text"
            value={address}
            onChange={(e) => setAddress(e.target.value)}
          />
        </label>
        <br />
        <label>
          Specialization:
          <input
            type="text"
            value={specialization}
            onChange={(e) => setSpecialization(e.target.value)}
          />
        </label>
        <br />
        <button type="submit">Update Doctor</button>
      </form>

      {updateStatus && <p>{updateStatus}</p>}
    </div>
  );
}

export default UpdateDoctor;
