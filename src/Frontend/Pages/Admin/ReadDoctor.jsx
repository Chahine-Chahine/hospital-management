import React, { useState, useEffect } from "react";
import { sendRequest } from "../../../core/helpers/request.js";

function UserDetails() {
  const [doctorID, setDoctorID] = useState(""); // State to store DoctorID input
  const [userData, setUserData] = useState(null);

  const fetchUserData = async (id) => {
    try {
      const response = await sendRequest({
        route: "Doctors/read",
        method: "POST",
        body: {
          DoctorID: id,
        },
      });

      console.log(response);

      // Handle the response accordingly
      if (response.status === "Success") {
        setUserData(response);
      } else {
        console.log("Failed to get user details. Status:", response.status);
      }
    } catch (error) {
      console.error("Error fetching user details:", error.message);
    }
  };

  useEffect(() => {
    // Fetch user data based on the specified path
    if (doctorID) {
      fetchUserData(doctorID);
    }
  }, [doctorID]);

  const handleDoctorIDChange = (e) => {
    setDoctorID(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (doctorID) {
      fetchUserData(doctorID);
    }
  };

  return (
    <div>
      <h2>User Details</h2>
      <form onSubmit={handleSubmit}>
        <label>
          Doctor ID:
          <input
            type="text"
            value={doctorID}
            onChange={handleDoctorIDChange}
          />
        </label>
        <button type="submit">Fetch User Data</button>
      </form>

      {userData ? (
        <div>
          <p>User ID: {userData.user_id}</p>
          <p>Username: {userData.Username}</p>
          <p>Email: {userData.Email}</p>
          <p>Address: {userData.Address}</p>
          <p>Specialization: {userData.Specialization}</p>
        </div>
      ) : (
        <p>Enter Doctor ID and click "Fetch User Data"</p>
      )}
    </div>
  );
}

export default UserDetails;
