// Form.jsx
import React, { useState } from "react";
import './Form.css';
import axios from 'axios';
import { useNavigate } from "react-router-dom";

function Form() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

const handleSignIn = async (e) => {
  e.preventDefault();

  try {
    const response = await axios.post(
      'http://localhost/hospital-managment/Backend/API/Auth/signin.php',
      `Email=${encodeURIComponent(email)}&Password=${encodeURIComponent(password)}`,
      { headers: { 'Content-Type': 'application/x-www-form-urlencoded' } }
    );

    console.log(response.data);
    
    if (response.data.status === "logged in") {
      console.log("User logged in successfully");
     
      navigate("/admin");
    } else if (response.data.status === "wrong credentials") {
      console.log("Login failed. Status:", response.data.status);
    } else {
      console.log("Unexpected response. Status:", response.data.status);
    }

  } catch (error) {
    console.error("Error signing in:", error.message);
  }
};


  return (
    <div className="Container">
      <div className="Form">
        <h1>Sign In</h1>
        <form onSubmit={handleSignIn}>
          <label htmlFor="email"></label>
          <input type="email" id="email" name="Email" placeholder="Email:" value={email} onChange={(e) => setEmail(e.target.value)} required />

          <label htmlFor="password"></label>
          <input type="password" id="password" name="Password" placeholder="Password:" value={password} onChange={(e) => setPassword(e.target.value)} required />

          <button type="submit">Sign In</button>
        </form>
      </div>
    </div>
  );
}

export default Form;
