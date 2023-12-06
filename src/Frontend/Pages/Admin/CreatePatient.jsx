import React, { useState } from "react";
import { sendRequest } from "../../../core/helpers/request.js";


function CreatePatient() {
  const [patientID, setPatientID] = useState("");
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [address, setAddress] = useState("");
  const [specialization, setSpecialization] = useState("");
  
  const resetForm = () => {
    setPatientID("");
    setUsername("");
    setPassword("");
    setFirstName("");
    setLastName("");
    setEmail("");
    setAddress("");
    setSpecialization("");
  };

  const handleCreatePatient = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Patients/create",
        method: "POST",
        body: {
          PatientID: patientID,
          Username: username,
          Password: password,
          FirstName: firstName,
          LastName: lastName,
          Email: email,
          Address: address,
          Specialization: specialization,
        },
      });

      console.log(response);

      if (response.status === "Success") {
        console.log("Patient created successfully");
        resetForm();
      } else {
        console.log("Failed to create patient. Status:", response.status);
      }
    } catch (error) {
      console.error("Error creating patient:", error.message);
    }
  };

  return (
    <div className="Container">
      <div className="createForm">
        <div className="wrapper">
          <h1>Create Patient</h1>
          <form onSubmit={handleCreatePatient}>
            <label htmlFor="patientID"></label>
            <input
              type="text"
              id="patientID"
              name="PatientID"
              placeholder="Patient ID:"
              value={patientID}
              onChange={(e) => setPatientID(e.target.value)}
              required
            />

            <label htmlFor="username"></label>
            <input
              type="text"
              id="username"
              name="Username"
              placeholder="Username:"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              required
            />

            <label htmlFor="password"></label>
            <input
              type="password"
              id="password"
              name="Password"
              placeholder="Password:"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />

            <label htmlFor="firstName"></label>
            <input
              type="text"
              id="firstName"
              name="FirstName"
              placeholder="First Name:"
              value={firstName}
              onChange={(e) => setFirstName(e.target.value)}
              required
            />

            <label htmlFor="lastName"></label>
            <input
              type="text"
              id="lastName"
              name="LastName"
              placeholder="Last Name:"
              value={lastName}
              onChange={(e) => setLastName(e.target.value)}
              required
            />

            <label htmlFor="email"></label>
            <input
              type="email"
              id="email"
              name="Email"
              placeholder="Email:"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />

            <label htmlFor="address"></label>
            <input
              type="text"
              id="address"
              name="Address"
              placeholder="Address:"
              value={address}
              onChange={(e) => setAddress(e.target.value)}
              required
            />

            <label htmlFor="specialization"></label>
            <input
              type="text"
              id="specialization"
              name="Specialization"
              placeholder="Specialization:"
              value={specialization}
              onChange={(e) => setSpecialization(e.target.value)}
              required
            />

            <button type="submit">Create</button>
          </form>
        </div>
      </div>
    </div>
  );
}

export default CreatePatient;
