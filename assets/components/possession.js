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

    useEffect(() => {
        client.get().then((response) => {
            setPossession(response.data.possessions);
        });
    }, []);

    return (
        <div>
            <h2>Possession de l'utilisateur</h2>
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
                return <tr>
                    <td>{poss.name}</td>
                    <td>{poss.value}</td>
                    <td>{poss.type}</td>
                </tr>
            })}
                </tbody>
            </table>
        </div>
    )
}

export default possession