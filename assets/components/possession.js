import { useParams } from "react-router-dom";
import axios from 'axios';
import { useEffect, useState } from 'react'
import React from 'react'




const possession = () => {
    let { id } = useParams();
    const client = axios.create({
        baseURL: (`http://localhost:8000/api/users/` + id)
    });

    const [possession, setPossession] = useState([]);
    const [user, setUser] = useState([]);

    useEffect(() => {
        client.get().then((response) => {
            setPossession(response.data.possessions);
        });

        client.get().then((response) => {
            setUser(response.data);
        });
    }, []);

    return (
        <div>
            <h2>Possession de l'utilisateur</h2>
            <h3>{user.name}</h3>
            <p>{user.mail}</p>
            <p>{user.phone}</p>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Valeur</th>
                        <th scope="col">Type</th>

                    </tr>
                </thead>
                <tbody>
            {possession.map((poss) => {
                return <tr key={poss.id}>
                    <td>{poss.name}</td>
                    <td>{poss.value + '€'}</td>
                    <td>{poss.type}</td>
                </tr>
            })}
                </tbody>
            </table>
        </div>
    )
}

export default possession