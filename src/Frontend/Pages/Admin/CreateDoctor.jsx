import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";
import './CreateDoctor.css'

function Form() {
  const [roleID, setRoleID] = useState("");
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [address, setAddress] = useState("");
  const [specialization, setSpecialization] = useState("");
  const [doctorID, setDoctorID] = useState("");
  const [deleteStatus, setDeleteStatus] = useState(null);

  const resetForm = () => {
    setRoleID("");
    setUsername("");
    setPassword("");
    setFirstName("");
    setLastName("");
    setEmail("");
    setAddress("");
    setSpecialization("");
    setDoctorID("");
    setDeleteStatus(null);
  };

  const handleSignUp = async (e) => {
    e.preventDefault();
  
    try {
      // Create a new doctor
      const createResponse = await sendRequest({
        route: "Doctors/create",
        method: "POST",
        body: {
          RoleID: roleID,
          Username: username,
          Password: password,
          FirstName: firstName,
          LastName: lastName,
          Email: email,
          Address: address,
          Specialization: specialization,
          DoctorID: doctorID, 
        },
      });
  
      console.log("Signup Response:", createResponse);
  
      if (createResponse && createResponse.status === "true") {
        console.log("User signed up successfully");
  
        // Retrieve the auto-generated UserID from the signup response
        const userID = createResponse.user_id;
  
        // Insert a new record into the Doctors table
        const insertDoctorResponse = await sendRequest({
          route: "Doctors/create",
          method: "POST",
          body: {
            DoctorID: doctorID,
            UserID: userID,
          },
        });
  
        console.log("Insert Doctor Response:", insertDoctorResponse);
  
        if (insertDoctorResponse && insertDoctorResponse.status === "true") {
          console.log("Doctor inserted successfully");
        } else {
          console.log("Failed to insert doctor. Status:", insertDoctorResponse ? insertDoctorResponse.status : "undefined");
        }
  
        resetForm();
      } else {
        console.log("Failed to sign up. Status:", createResponse ? createResponse.status : "undefined");
      }
    } catch (error) {
      console.error("Error signing up or inserting doctor:", error.message);
    }
  };
  

  return (
    <div className="Container">
      <div className="createForm">
        <div className="wrapper">
          <h1>Create Doctor</h1>
          <form onSubmit={handleSignUp}>
            <label htmlFor="roleID">Role ID:</label>
            <input
              type="text"
              id="roleID"
              name="RoleID"
              placeholder="Role ID"
              value={roleID}
              onChange={(e) => setRoleID(e.target.value)}
              required
            />

            <label htmlFor="username">Username:</label>
            <input
              type="text"
              id="username"
              name="Username"
              placeholder="Username"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              required
            />

            <label htmlFor="password">Password:</label>
            <input
              type="password"
              id="password"
              name="Password"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />

            <label htmlFor="firstName">First Name:</label>
            <input
              type="text"
              id="firstName"
              name="FirstName"
              placeholder="First Name"
              value={firstName}
              onChange={(e) => setFirstName(e.target.value)}
              required
            />

            <label htmlFor="lastName">Last Name:</label>
            <input
              type="text"
              id="lastName"
              name="LastName"
              placeholder="Last Name"
              value={lastName}
              onChange={(e) => setLastName(e.target.value)}
              required
            />

            <label htmlFor="email">Email:</label>
            <input
              type="email"
              id="email"
              name="Email"
              placeholder="Email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />

            <label htmlFor="address">Address:</label>
            <input
              type="text"
              id="address"
              name="Address"
              placeholder="Address"
              value={address}
              onChange={(e) => setAddress(e.target.value)}
              required
            />

            <label htmlFor="specialization">Specialization:</label>
            <input
              type="text"
              id="specialization"
              name="Specialization"
              placeholder="Specialization"
              value={specialization}
              onChange={(e) => setSpecialization(e.target.value)}
              required
            />

            <label htmlFor="doctorID">Doctor ID to insert:</label>
            <input
              type="number"
              id="doctorID"
              name="DoctorID"
              placeholder="Doctor ID to insert"
              value={doctorID}
              onChange={(e) => setDoctorID(e.target.value)}
              required
            />

            <button type="submit">Create Doctor</button>
          </form>
        </div>
      </div>
    </div>
  );
}

export default Form;
