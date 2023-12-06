import CreatePatientRecord from "./CreateRecord";
import ReadPatientRecord from "./ReadRecord";



function PatientPage(){


    return (
        <>
        <CreatePatientRecord/>
        <br/>
        <ReadPatientRecord/>
        </>
    )
}


export default PatientPage;