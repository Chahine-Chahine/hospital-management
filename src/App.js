import './App.css';
import { useEffect } from 'react';
import axios from 'axios';

function App() {
  useEffect(() => {
    axios
      .get("http://localhost/hospital-managment/Backend/connection.php")
      .then((res) => {
        console.log(res.data);
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }, []);

  return (
    <div>
      This is your React App!
    </div>
  );
}

export default App;
