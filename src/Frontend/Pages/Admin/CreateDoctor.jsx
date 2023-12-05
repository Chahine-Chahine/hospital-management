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
  
  const resetForm = () => {
    setRoleID("");
    setUsername("");
    setPassword("");
    setFirstName("");
    setLastName("");
    setEmail("");
    setAddress("");
    setSpecialization("");
  };

  const handleSignUp = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Auth/signup",
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
        },
      });

      console.log(response);

     
      if (response.status === "true") {
        console.log("User signed up successfully");
        resetForm(); 
      } else {
        console.log("Failed to sign up. Status:", response.status);
      }
    } catch (error) {
      console.error("Error signing up:", error.message);
    }
  };

  return (
    <div className="Container">
      <div className="createForm">
        <div className="wrapper">
          <h1>Create Doctor</h1>
          <form onSubmit={handleSignUp}>
            <label htmlFor="roleID"></label>
            <input
              type="text"
              id="roleID"
              name="RoleID"
              placeholder="Role ID:"
              value={roleID}
              onChange={(e) => setRoleID(e.target.value)}
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

export default Form;
