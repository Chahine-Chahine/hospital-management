// Form.jsx
import React, { useState } from "react";
import './Form.css';
import { useNavigate } from "react-router-dom";
import { sendRequest } from "../../core/helpers/request";

function Form() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleSignIn = async (e) => {
    e.preventDefault();

    try {
      const response = await sendRequest({
        route: "Auth/signin",
        method: "POST",
        body: `Email=${encodeURIComponent(email)}&Password=${encodeURIComponent(password)}`,
      });

      console.log(response);

      if (response.status === "logged in") {
        console.log("User logged in successfully");
        if(response.RoleID === 1){
          navigate("/admin");
        }else if(response.RoleID === 2){
          navigate("/doctor")
        }
        else if(response.RoleID === 3){
          navigate("/patient")
        }else{
          alert("Error in setting the role!")
        }
      } else if (response.status === "wrong credentials") {
        console.log("Login failed. Status:", response.status);
      } else {
        console.log("Unexpected response. Status:", response.status);
      }
    } catch (error) {
      console.error("Error signing in:", error.message);
    }
  };

  return (
    <div className="Container">
      <div className="Form">
        <div className="wrapper">
        <h1>Sign In</h1>
        <form onSubmit={handleSignIn}>
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

          <button type="submit">Sign In</button>
          
        </form>
        </div>
      </div>
    </div>
  );
}

export default Form;
