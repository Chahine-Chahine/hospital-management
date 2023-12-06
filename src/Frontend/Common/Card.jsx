import './Card.css'



function Card(){




    return(
        <>
    <div className="cardContainer">
        <div className="card one">
            <h1>CRUD Operations</h1>
            <a href='/admin/create-doctor'>Create Doctor</a>
            <a href='/admin/create-patient'>Create Patient</a>
            <a href='/admin/read-doctor'>Read Doctor</a>
            <a href='/admin/read-patient'>Read Patient</a>
            <a href='/admin/update-doctor'>Update Doctor</a>
            <a href='/admin/update-patient'>Update Patient</a>
            <a href='/admin/delete-doctor'>Delete Doctor</a>
            <a href='/admin/delete-patient'>Delete Patient</a>
        </div>
        <div className="card two"></div>
        <div className="card three"></div>
    </div>
        </>
    )
}


export default Card;